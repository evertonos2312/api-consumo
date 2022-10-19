<?php

namespace App\Repositories;

use App\Models\ConfigEnergia;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\User;
use App\Models\View;
use App\Repositories\Traits\RepositoryTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getLessonsCourse(string $courseId)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->get();

    }

    public function createNewUser(array $data)
    {
        $permissionLevel = match ($data['permission_code']) {
            env('REGISTER_USER') => 'user_register',
            env('ADMIN_USER') => 'admin_register',
            default => '',
        };
        if(empty($permissionLevel)){
            return false;
        }
        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = $permissionLevel == 'admin_register';
        $data['permission'] = $permissionLevel == 'admin_register' ? 'w' : 'r';
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
        $user = $this->getLessonByUuid($identify);
        $data['course_id'] = $courseId;
        Cache::forget('courses');
        return $user->update($data);
    }

    public function deleteLessonByUuid(string $identify)
    {
        $user = $this->getLessonByUuid($identify);
        Cache::forget('courses');
        return $user->delete();
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
