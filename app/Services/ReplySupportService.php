<?php

namespace App\Services;

use App\Repositories\ReplySupportRepository;
use App\Repositories\SupportRepository;

class ReplySupportService
{
    protected $replySupportRepository;

    public function __construct( ReplySupportRepository $replySupportRepository) {
        $this->replySupportRepository = $replySupportRepository;
    }

    public function createReplyToSupport($data)
    {
        return $this->replySupportRepository->createReplyBySupportId($data);
    }

}
