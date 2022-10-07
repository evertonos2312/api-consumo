<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupport;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupportController extends Controller
{
    protected $supportService;

    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $support = $this->supportService->getSupports($request->all());
        return SupportResource::collection($support);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function userSupports(Request $request)
    {
        $support = $this->supportService->getUserSupports($request->all());
        return SupportResource::collection($support);
    }

    public function store(StoreSupport $request)
    {
        $support = $this->supportService->createNewSupport($request->validated());
        return new SupportResource($support);
    }
}
