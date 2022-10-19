<?php


use App\Http\Controllers\Api\Auth\{
    AuthController,
    ResetPasswordController};
use App\Http\Controllers\Api\{ConfigEnergiaController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SubmoduleController,
    SupportController,
    UserController};
use Illuminate\Support\Facades\Route;


Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/create-user', [UserController::class, 'store'])->middleware('guest');


Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/users', function () {
    })->middleware(['auth:sanctum', 'ability:create-users']);
    Route::apiResource('/config-energy', ConfigEnergiaController::class);


    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/courses/{course}/lessons', LessonController::class);
    Route::apiResource('/modules/{module}/submodules', SubmoduleController::class);
    Route::apiResource('/modules', ModuleController::class);
    Route::get('/supports/user', [SupportController::class, 'userSupports']);
    Route::post('/replies', [ReplySupportController::class, 'createReply']);
});


