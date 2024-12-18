<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Enums\TokenAbilityEnum;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if(!Hash::check($request->password, $user->password)){
                throw new AuthenticationException();
            }

            auth()->login($user);

            $accessTokenExpiration = now()->addMinutes(config('sanctum.at_expiration'));
            $refreshTokenExpiration = now()->addMinutes(config('sanctum.rt_expiration'));
            $accessToken =  auth()->user()->createToken(
                name: 'access token',
                abilities: [TokenAbilityEnum::ACCESS_TOKEN->value],
                expiresAt: $accessTokenExpiration
            );
            $refreshToken =  auth()->user()->createToken(
                name: 'refresh token',
                abilities: [TokenAbilityEnum::ISSUE_ACCESS_TOKEN->value],
                expiresAt: $refreshTokenExpiration
            );
            return response()->json([
                'access_token' => $accessToken->plainTextToken,
                'refresh_token' => $refreshToken->plainTextToken,
                'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
                'rf_expired_at' => $refreshTokenExpiration->format('Y-m-d H:i:s'),
            ]);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("User not found");
        }
    }

    /**
     * Summary of refreshToken
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        $accessTokenExpiration = now()->addMinutes(config('sanctum.at_expiration'));
        $accessToken =  auth()->user()->createToken(
            name: 'access token',
            abilities: [TokenAbilityEnum::ACCESS_TOKEN->value],
            expiresAt: $accessTokenExpiration
        );
        return response()->json([
            'access_token' => $accessToken->plainTextToken,
            'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Summary of logout
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => "Logout successful"
        ]);
    }

}
