<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return new UserResource($request->user());
    });
    Route::post('page/create', [PageController::class,'store']);
    Route::post('follow/{type}/{id}',[FollowController::class,'follow']);
    Route::post('person/attach-post',[PostController::class,'postByUser']);
    Route::post('page/{page}/attach-post',[PostController::class,'postByPage']);
    Route::post('person/feed',[PostController::class,'index']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
