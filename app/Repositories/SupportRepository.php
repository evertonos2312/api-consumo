<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Cache;

class SupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $support)
    {
        $this->entity = $support;
    }

    public function getSupportsByUserAuth(array $filters = [])
    {
        $filters['user'] = true;
        return $this->getAllSupports($filters);
    }

    public function getAllSupports(array $filters = [])
    {
        return $this->entity
            ->where(function ($query) use ($filters){
                if(isset($filters['lesson'])){
                    $query->where('lesson_id', $filters['lesson']);
                }
                if(isset($filters['status'])){
                    $query->where('status', $filters['status']);
                }
                if(isset($filters['filter'])){
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }
                if(isset($filters['user'])){
                    $user = $this->getUserAuth();
                    $query->where('user_id', $user->id);
                }
            })->orderByDesc('updated_at')->get();
    }

    public function createNewSupport(array $data)
    {
        return $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'status' => $data['status'],
            'description' => $data['description'],
        ]);
    }

}
