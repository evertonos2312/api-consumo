<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSubmodule;
use App\Http\Resources\SubmoduleResource;
use App\Services\SubmoduleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubmoduleController extends Controller
{
    protected $submoduleService;

    public function __construct(SubmoduleService $submoduleService)
    {
        $this->submoduleService = $submoduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($module)
    {
        $submodules = $this->submoduleService->getSubmodulesByModule($module);
        return SubmoduleResource::collection($submodules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateSubmodule $request
     * @param $module
     * @return SubmoduleResource
     */
    public function store(StoreUpdateSubmodule $request, $module)
    {
        $submodule = $this->submoduleService->createNewSubmodule($request->validated());
        return new SubmoduleResource($submodule);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return SubmoduleResource
     */
    public function show($module, $identify)
    {
        $submodule = $this->submoduleService->getSubmoduleByModule($module, $identify);
        return new SubmoduleResource($submodule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateSubmodule $request, $module, $identify)
    {
        $this->submoduleService->updateSubmodule($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($module, $identify)
    {
        $this->submoduleService->deleteSubmodule($identify);
        return response()->json([], 204);
    }
}
