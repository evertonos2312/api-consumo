<?php

namespace App\Services;

use App\Repositories\ModuleRepository;

class ModuleService
{
    protected $repository;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getModules()
    {
        return $this->repository->getAllModules();
    }

    public function createNewModule(array $data)
    {
        return $this->repository->createNewModule($data);
    }

    public function getModule(string $identify)
    {
        return $this->repository->getModuleByUuid($identify);
    }

    public function deleteModule(string $identify)
    {
        return $this->repository->deleteModuleByUuid($identify);
    }

    public function updateModule(string $identify, array $data)
    {
        return $this->repository->updateModuleByUuid($identify, $data);
    }
}
