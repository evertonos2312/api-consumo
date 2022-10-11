<?php

namespace App\Services;

use App\Repositories\ConfigEnergiaRepository;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function getLessonsByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->userRepository->getLessonsCourse($course->id);
    }

    public function createNewUser(array $data)
    {
        return $this->userRepository->createNewUser($data);
    }

    public function getLessonByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->userRepository->getLessonByCourse($course->id, $identify);
    }

    public function updateLesson(string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->userRepository->updateLessonByUuid($course->id, $identify, $data);
    }

    public function deleteLesson(string $identify)
    {
        return $this->userRepository->deleteLessonByUuid($identify);
    }

    public function LessonViewed(string $identify)
    {
        return $this->userRepository->markLessonViewed($identify);
    }
}
