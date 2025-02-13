<?php

namespace App\Actions\Core\v1\Auth;

use App\Actions\Core\v1\Auth\Otp\SendAction;
use App\Dto\Core\v1\Auth\RegistrationDto;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Cache;
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
            'phone' => $dto->phone,
            'password' => $dto->password
        ];

        Cache::put('user_' . $dto->phone, $data, now()->addHour());

        $sendaction = app(SendAction::class);
        return $sendaction($data);

        // $user = User::create($data);
        // $user->sendEmailVerificationNotification();
        // return static::toResponse(
        //     message: "Paydalaniwshi jaratildi, ko'rsetilgen email addressin'izdi tastiyiqlaw ushin pochtan'izg'a xat ketti"
        // );
    }
}