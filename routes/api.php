<?php

use App\Http\Controllers\CategoryController;
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

// Category
Route::apiResource('/category', CategoryController::class)->except([
    'show',
    'destroy',
    'update',
]);
Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::put('/category/{category:slug}', [CategoryController::class, 'update']);
Route::delete('/category/{category:slug}', [CategoryController::class, 'destroy']);