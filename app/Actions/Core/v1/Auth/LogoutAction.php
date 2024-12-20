<?php

namespace App\Actions\Core\v1\Auth;

use Illuminate\Http\JsonResponse;

class LogoutAction
{
    public function __invoke(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => "Logout successful"
        ]);
    }
}