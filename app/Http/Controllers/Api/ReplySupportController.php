<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplySupportResource;
use App\Services\ReplySupportService;

class ReplySupportController extends Controller
{
    protected $replySupportService;

    public function __construct(ReplySupportService $replySupportService)
    {
        $this->replySupportService = $replySupportService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ReplySupportResource
     */
    public function createReply(StoreReplySupport $request): ReplySupportResource
    {
        $reply = $this->replySupportService->createReplyToSupport($request->validated());
        return new ReplySupportResource($reply);
    }

}
