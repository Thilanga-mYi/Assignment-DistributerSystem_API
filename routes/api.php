<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/LOGIN',[UserController::class,'loginAPI']);
Route::post('/user/REGISTRATION',[UserController::class,'register']);
Route::post('/login',[UserController::class,'loginAPI']);
Route::post('/post/REGISTER', [PostController::class, 'registerPosts']);
Route::get('/post/GET_ONE', [PostController::class, 'getPost']);
Route::get('/post/GET_ALL', [PostController::class, 'getAllPosts']);
