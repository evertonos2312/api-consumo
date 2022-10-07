<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return Cache::remember('courses', 900, function () {
            return $this->entity->withWhereHas('lessons', function($db) {
                $db->whereDate('lessons.inicio', '>',  Carbon::now('America/Sao_Paulo'));
            })->get();
        });
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        $query =  $this->entity->where('id', $identify);
        if($loadRelationships) {
            $query->with('lessons');
        }
        return $query->firstOrFail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course =  $this->getCourseByUuid($identify);
        Cache::forget('courses');
        return $course->delete();
    }

    public function updateCourseByUuid(string $identify, array $data)
    {
        $course =  $this->getCourseByUuid($identify);
        Cache::forget('courses');
        return $course->update($data);
    }
}
