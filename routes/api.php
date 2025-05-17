<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\PostApplicationController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\SkillUserController;
use App\Models\Category;
use App\Http\Controllers\API\CategoryJobController;
use App\Http\Controllers\API\JobUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/applications', [ApplicationController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/applications/{id}', [ApplicationController::class, 'destroy']);
    Route::put('/applications/{id}', [ApplicationController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/categories', [CategoryController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/jobs', [JobController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/jobs', [JobController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/jobs/{id}', [JobController::class, 'destroy']);
    Route::put('/jobs/{id}', [JobController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/message', [MessageController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/message', [MessageController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/message/{id}', [MessageController::class, 'destroy']);
    Route::put('/message/{id}', [MessageController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/notification', [NotificationController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/notification/{id}', [NotificationController::class, 'destroy']);
    Route::put('/notification/{id}', [NotificationController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/payment', [PaymentController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/payment/{id}', [PaymentController::class, 'destroy']);
    Route::put('/payment/{id}', [PaymentController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/review', [ReviewController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/review', [ReviewController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/review/{id}', [ReviewController::class, 'destroy']);
    Route::put('/review/{id}', [ReviewController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/skill', [SkillController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/skill', [SkillController::class, 'post']);
    Route::middleware('auth:sanctum')->delete('/skill/{id}', [SkillController::class, 'destroy']);
    Route::put('/skill/{id}', [SkillController::class, 'update']);
});

//skilluser
Route::post('/users/{user}/skills', [SkillUserController::class, 'attachSkill']);
Route::delete('/users/{user}/skills/{skill}', [SkillUserController::class, 'detachSkill']);
Route::get('/users/{user}/skills', [SkillUserController::class, 'listSkills']);
Route::put('/users/{user}/skills', [SkillUserController::class, 'updateSkills']);


//categoryjob
Route::post('/jobs/{job}/categories', [CategoryJobController::class, 'attachCategory']);
Route::delete('/jobs/{job}/categories', [CategoryJobController::class, 'detachCategory']);
Route::get('/jobs/{job}/categories', [CategoryJobController::class, 'listCategories']);
Route::put('/jobs/{job}/categories', [CategoryJobController::class, 'updateCategories']);


//jobuser
Route::post('/users/{user}/jobs', [JobUserController::class, 'attachJob']);
Route::delete('/users/{user}/jobs', [JobUserController::class, 'detachJob']);
Route::get('/users/{user}/jobs', [JobUserController::class, 'listJobs']);
Route::put('/users/{user}/jobs', [JobUserController::class, 'updateJobs']);
