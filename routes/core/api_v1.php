<?php


use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::prefix('auth')->middleware('guest:sanctum')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});


Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::get('test1', function () {
        return response()->json([
            'message' => 'authorized',
        ]);
    });
});



Route::get('posts', [PostController::class, 'post']);
