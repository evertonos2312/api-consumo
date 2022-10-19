<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Requests\StoreUpdateSubmodule;
use App\Http\Requests\StoreUser;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($course): AnonymousResourceCollection
    {
        $lessons = $this->userService->getLessonsByCourse($course);
        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUser $request
     * @return JsonResponse
     */
    public function store(StoreUser $request): JsonResponse
    {
        return (
            $this->userService->createNewUser($request->validated())
                ? response()->json(['message' => 'created'])
                : response('', 424)->json(['message' => 'failed'])
        ) ;
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return LessonResource
     */
    public function show($course, string $identify): LessonResource
    {
        $lesson = $this->userService->getLessonByCourse($course, $identify);
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(StoreUpdateLesson $request, $course, string $identify): JsonResponse
    {
        $this->userService->updateLesson($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return JsonResponse
     */
    public function destroy($course, string $identify): JsonResponse
    {
        $this->userService->deleteLesson($identify);
        return response()->json([], 204);
    }

}
