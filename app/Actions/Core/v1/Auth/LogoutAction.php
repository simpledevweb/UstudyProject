<?php

namespace App\Actions\Core\v1\Auth;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class LogoutAction
{
    use ResponseTrait;

    public function __invoke(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return static::toResponse(
            message: "Logout successful"
        );
    }
}