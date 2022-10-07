<?php

namespace App\Services;

use App\Repositories\SupportRepository;

class SupportService
{
    protected $supportRepository;

    public function __construct(
        SupportRepository $supportRepository
    ) {
        $this->supportRepository = $supportRepository;
    }

    public function getSupports(array $filters = [])
    {
        return $this->supportRepository->getAllSupports($filters);
    }

    public function createNewSupport(array $data)
    {
        return $this->supportRepository->createNewSupport($data);
    }

    public function getUserSupports(array $filters = [])
    {
        return $this->supportRepository->getSupportsByUserAuth($filters);
    }
}
