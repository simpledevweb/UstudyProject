<?php

namespace App\Actions\Core\v1\Auth;

use App\Enums\TokenAbilityEnum;
use Illuminate\Http\JsonResponse;

class RefreshTokenAction
{
    public function __invoke(): JsonResponse
    {
        $accessTokenExpiration = now()->addMinutes(config('sanctum.at_expiration'));
        $accessToken = auth()->user()->createToken(
            name: 'access token',
            abilities: [TokenAbilityEnum::ACCESS_TOKEN->value],
            expiresAt: $accessTokenExpiration
        );
        return response()->json([
            'access_token' => $accessToken->plainTextToken,
            'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
        ]);
    }
}