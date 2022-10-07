<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Requests\StoreUpdateSubmodule;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($course): AnonymousResourceCollection
    {
        $lessons = $this->lessonService->getLessonsByCourse($course);
        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateLesson $request
     * @param $course
     * @return LessonResource
     */
    public function store(StoreUpdateLesson $request, $course): LessonResource
    {
        $lesson = $this->lessonService->createNewLesson($request->validated());
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return LessonResource
     */
    public function show($course, string $identify): LessonResource
    {
        $lesson = $this->lessonService->getLessonByCourse($course, $identify);
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
        $this->lessonService->updateLesson($identify, $request->validated());
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
        $this->lessonService->deleteLesson($identify);
        return response()->json([], 204);
    }

    public function markLessonViewed(StoreView $request):JsonResponse
    {
        $this->lessonService->LessonViewed($request->lesson);
        return response()->json(['success' => true]);
    }
}
