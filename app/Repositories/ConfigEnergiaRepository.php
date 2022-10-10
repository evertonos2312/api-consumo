<?php

namespace App\Repositories;

use App\Models\ConfigEnergia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ConfigEnergiaRepository
{
    protected $entity;

    public function __construct(ConfigEnergia $course)
    {
        $this->entity = $course;
    }

    public function getAllConfigs()
    {
        return Cache::remember('configEnergia', 900, function () {
           return $this->entity->get();
        });
    }

    public function createNewConfig(array $data)
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
