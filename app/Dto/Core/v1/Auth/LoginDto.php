<?php

namespace App\Dto\Core\v1\Auth;

use App\Http\Requests\Core\v1\Auth\LoginRequest;
class LoginDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Core\v1\Auth\LoginRequest $request
     * @return \App\Dto\Core\v1\Auth\LoginDto
     */
    public static function from(LoginRequest $request): self
    {
        return new self(
            email: $request->email,
            password: $request->password
        );
    }

}