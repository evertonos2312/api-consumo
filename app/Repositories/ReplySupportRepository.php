<?php

namespace App\Repositories;

use App\Models\ConfigEnergia;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Cache;

class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $support)
    {
        $this->entity = $support;
    }

    public function createReplyBySupportId(array $data)
    {
        $user = $this->getUserAuth();
        return $this->entity->create([
            'support_id' => $data['support'],
            'description' => $data['description'],
            'user_id' => $user->id
       ]);
    }
}
