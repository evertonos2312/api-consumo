<?php

namespace App\Repositories\Traits;

use Illuminate\Contracts\Auth\Authenticatable;

trait RepositoryTrait
{

    private function getUserAuth() : Authenticatable
    {
        return auth()->user();
    }
}
