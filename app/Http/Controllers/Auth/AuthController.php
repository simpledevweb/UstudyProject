<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

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

            return response()->json([
               'token' =>$user->createToken('core_api')->plainTextToken,
                'user' => $user,
            ]);

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("User not found");
        }
    }

}
