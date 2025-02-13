<?php


use App\Enums\TokenAbilityEnum;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\OtpVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/* Pattern */
Route::pattern('id', '\d+');

/* Public */
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'post']);
    Route::get('show/{id}', [PostController::class, 'show']);
});

/* Guest */
Route::prefix('auth')->middleware('guest:sanctum')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::get('email/verify/{id}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('otp/accept', [OtpVerificationController::class, 'accept']);
});

/* Auth for Refresh token*/
Route::prefix('auth')->middleware(['auth:sanctum', 'ability:' . TokenAbilityEnum::ISSUE_ACCESS_TOKEN->value])->group(function () {
    Route::post('refresh-token', [AuthController::class, 'refreshToken']);
});

/* Auth for Access token*/
Route::middleware(['auth:sanctum', 'ability:' . TokenAbilityEnum::ACCESS_TOKEN->value])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('email/resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');
    });
});

/**
 * Routs for Auth & Verified Users
 */
Route::middleware(['auth:sanctum', 'ability:' . TokenAbilityEnum::ACCESS_TOKEN->value, 'verified'])->group(function () {
    Route::get('test', function () {
        return response()->json("You're verified!");
    });
});