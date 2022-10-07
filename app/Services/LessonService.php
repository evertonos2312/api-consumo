<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;

class LessonService
{
    protected $lessonRepository;
    protected $courseRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        CourseRepository $courseRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getLessonsByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->lessonRepository->getLessonsCourse($course->id);
    }

    public function createNewLesson(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->lessonRepository->createNewLesson($course->id, $data);
    }

    public function getLessonByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->lessonRepository->getLessonByCourse($course->id, $identify);
    }

    public function updateLesson(string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->lessonRepository->updateLessonByUuid($course->id, $identify, $data);
    }

    public function deleteLesson(string $identify)
    {
        return $this->lessonRepository->deleteLessonByUuid($identify);
    }

    public function LessonViewed(string $identify)
    {
        return $this->lessonRepository->markLessonViewed($identify);
    }
}
