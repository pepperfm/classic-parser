<?php

use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    'users' => \App\Http\Controllers\UserController::class,
    'posts' => \App\Http\Controllers\PostController::class,
    'comments' => \App\Http\Controllers\CommentController::class,
]);
