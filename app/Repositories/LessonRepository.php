<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\View;
use App\Repositories\Traits\RepositoryTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsCourse(string $courseId)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->get();

    }

    public function createNewLesson(string $courseId, array $data)
    {
        if(isset($data['max_cancelamento'])) {
            $data['max_cancelamento'] = Carbon::createFromFormat('d/m/Y H:i',$data['max_cancelamento'])->format('Y-m-d H:i:s') ;
        }
        $data['course_id'] = $courseId;
        $data['inicio'] =   Carbon::createFromFormat('d/m/Y H:i',$data['inicio'])->format('Y-m-d H:i:s');
        $data['termino'] = Carbon::createFromFormat('d/m/Y H:i',$data['termino'])->format('Y-m-d H:i:s');
        Cache::forget('courses');
        return $this->entity->create($data);
    }

    public function getLessonByCourse(string $courseId, string $identify)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->where('id', $identify)
            ->firstOrfail();
    }

    public function getLessonByUuid(string $identify)
    {
        return $this->entity
            ->where('id', $identify)
            ->firstOrfail();
    }

    public function updateLessonByUuid(string $courseId, string $identify, array $data)
    {
        $lesson = $this->getLessonByUuid($identify);
        $data['course_id'] = $courseId;
        Cache::forget('courses');
        return $lesson->update($data);
    }

    public function deleteLessonByUuid(string $identify)
    {
        $lesson = $this->getLessonByUuid($identify);
        Cache::forget('courses');
        return $lesson->delete();
    }

    public function markLessonViewed(string $identify)
    {
        $user = $this->getUserAuth();
        $view = $user->views()->where('lesson_id', $identify)->first();
        if($view){
            return $view->update([
                'qty' => $view->qty +1
            ]);
        }
        return $user->views()->create([
            'lesson_id' => $identify
        ]);
    }
}
