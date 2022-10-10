<?php

namespace App\Repositories;

use App\Models\ConfigEnergia;
use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModules()
    {
            return $this->entity->with('submodules')->get();
//        return Cache::remember('courses', 900, function () {
//        });
    }

    public function createNewModule(array $data)
    {
        return $this->entity->create($data);
    }

    public function getModuleByUuid(string $identify, bool $loadRelationships = true)
    {
        $query =  $this->entity->where('id', $identify);
        if($loadRelationships) {
            $query->with('submodules');
        }
        return $query->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify)
    {
        $course =  $this->getModuleByUuid($identify, false);
        Cache::forget('courses');
        return $course->delete();
    }

    public function updateModuleByUuid(string $identify, array $data)
    {
        $course =  $this->getModuleByUuid($identify, false);
        Cache::forget('courses');
        return $course->update($data);
    }
}
