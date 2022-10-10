<?php

namespace App\Services;

use App\Repositories\ConfigEnergiaRepository;

class ConfigEnergiaService
{
    protected $repository;

    public function __construct(ConfigEnergiaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getConfigs()
    {
        return $this->repository->getAllConfigs();
    }

    public function createNewConfig(array $data)
    {
        return $this->repository->createNewConfig($data);
    }

    public function getCourse(string $identify)
    {
        return $this->repository->getCourseByUuid($identify);
    }

    public function deleteCourse(string $identify)
    {
        return $this->repository->deleteCourseByUuid($identify);
    }

    public function updateCourse(string $identify, array $data)
    {
        return $this->repository->updateCourseByUuid($identify, $data);
    }
}
