<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Core\v1\Auth\LoginAction;
use App\Actions\Core\v1\Auth\LogoutAction;
use App\Actions\Core\v1\Auth\RefreshTokenAction;
use App\Actions\Core\v1\Auth\RegistrationAction;
use App\Dto\Core\v1\Auth\LoginDto;
use App\Dto\Core\v1\Auth\RegistrationDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\v1\Auth\LoginRequest;
use App\Http\Requests\Core\v1\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller
{
    /**
     * Summary of login with action and dto
     * @param \App\Http\Requests\Core\v1\Auth\LoginRequest $request
     * @param \App\Actions\Core\v1\Auth\LoginAction $action
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        return $action(LoginDto::from($request));
    }

    /**
     * Summary of refreshToken
     * @param \App\Actions\Core\v1\Auth\RefreshTokenAction $action
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function refreshToken(RefreshTokenAction $action): JsonResponse
    {
        return $action();
    }

    public function signup(RegistrationAction $action, RegistrationRequest $request): JsonResponse
    {
        return $action(RegistrationDto::from($request));
    }

    /**
     * Summary of logout
     * @param \App\Actions\Core\v1\Auth\LogoutAction $action
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logout(LogoutAction $action): JsonResponse
    {
        return $action();
    }

}