<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $courses = $this->moduleService->getModules();
        return ModuleResource::collection($courses);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateModule $request
     * @return ModuleResource
     */
    public function store(StoreUpdateModule $request): ModuleResource
    {
        $module = $this->moduleService->createNewModule($request->validated());
        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return ModuleResource
     */
    public function show($identify): ModuleResource
    {
        $module = $this->moduleService->getModule($identify);
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateModule $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(StoreUpdateModule $request, string $identify): JsonResponse
    {
        $this->moduleService->updateModule($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return JsonResponse
     */
    public function destroy(string $identify): JsonResponse
    {
        $this->moduleService->deleteModule($identify);
        return response()->json([], 204);
    }
}
