<?php

namespace App\Actions\Core\v1\Auth;

use App\Dto\Core\v1\Auth\RegistrationDto;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
class RegistrationAction
{
    use ResponseTrait;
    /**
     * Summary of __invoke
     * @param \App\Dto\Core\v1\Auth\RegistrationDto $dto
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegistrationDto $dto): JsonResponse
    {
        $data = [
            'country_id' => $dto->country_id,
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password
        ];

        User::create($data);

        return static::toResponse(code: 200, message: "Paydalaniwshi qosildi!");
    }
}