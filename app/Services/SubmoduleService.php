<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use App\Repositories\SubmoduleRepository;

class SubmoduleService
{
    protected $submoduleRepository;
    protected $moduleRepository;

    public function __construct(
        SubmoduleRepository $submoduleRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->submoduleRepository = $submoduleRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getSubmodulesByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        return $this->submoduleRepository->getSubmodulesModule($module->id);
    }

    public function createNewSubmodule(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);
        return $this->submoduleRepository->createNewSubmodule($module->id, $data);
    }

    public function getSubmoduleByModule(string $module, string $identify)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        return $this->submoduleRepository->getSubmoduleByModule($module->id, $identify);
    }

    public function updateSubmodule(string $identify, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);
        return $this->submoduleRepository->updateSubmoduleByUuid($module->id, $identify, $data);
    }

    public function deleteSubmodule(string $identify)
    {
        return $this->submoduleRepository->deleteSubmoduleByUuid($identify);
    }
}
