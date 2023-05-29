<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Category
    Route::apiResource('/category', CategoryController::class)->except([
        'show',
        'destroy',
        'update',
    ]);
    Route::prefix('/category')->group(function () {
        Route::get('/{category:slug}', [CategoryController::class, 'show']);
        Route::put('/{category:slug}', [CategoryController::class, 'update']);
        Route::delete('/{category:slug}', [CategoryController::class, 'destroy']);
    });
    // 

    // Post
    Route::apiResource('/post', PostController::class)->except([
        'show',
        'destroy',
        'update',
    ]);
    Route::prefix('/post')->group(function () {
        Route::get('/{post:slug}', [PostController::class, 'show']);
        Route::put('/{post:slug}', [PostController::class, 'update']);
        Route::delete('/{post:slug}', [PostController::class, 'destroy']);
    });

    // User
    Route::apiResource('/user', UserController::class)->except([
        'store'
    ]);

    // Auth
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);