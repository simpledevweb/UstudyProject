<?php

namespace App\Dto\Core\v1\Auth;

use App\Http\Requests\Core\v1\Auth\LoginRequest;
use App\Http\Requests\Core\v1\Auth\RegistrationRequest;
class RegistrationDto
{
    public function __construct(
        public int $country_id,
        public string $name,
        public string $email,
        public string $password
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Core\v1\Auth\LoginRequest $request
     * @return \App\Dto\Core\v1\Auth\LoginDto
     */
    public static function from(RegistrationRequest $request): self
    {
        return new self(
            country_id: $request->country_id,
            name: $request->name,
            email: $request->email,
            password: $request->password,

        );
    }

}