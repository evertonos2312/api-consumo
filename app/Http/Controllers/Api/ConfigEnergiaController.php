<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateConfigEnergia;
use App\Http\Resources\ConfigEnergiaResource;
use App\Services\ConfigEnergiaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConfigEnergiaController extends Controller
{
    protected $configEnergiaService;

    public function __construct(ConfigEnergiaService $configEnergiaService)
    {
        $this->configEnergiaService = $configEnergiaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $configs = $this->configEnergiaService->getConfigs();
        return ConfigEnergiaResource::collection($configs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateConfigEnergia $request
     * @return ConfigEnergiaResource
     */
    public function store(StoreUpdateConfigEnergia $request): ConfigEnergiaResource
    {
        $course = $this->configEnergiaService->createNewConfig($request->validated());
        return new ConfigEnergiaResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return ConfigEnergiaResource
     */
    public function show(string $identify): ConfigEnergiaResource
    {
        $course = $this->configEnergiaService->getCourse($identify);
        return new ConfigEnergiaResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateConfigEnergia $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(StoreUpdateConfigEnergia $request, string $identify): JsonResponse
    {
        $this->configEnergiaService->updateCourse($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $identify): JsonResponse
    {
        $this->configEnergiaService->deleteCourse($identify);
        return response()->json([], 204);
    }
}
