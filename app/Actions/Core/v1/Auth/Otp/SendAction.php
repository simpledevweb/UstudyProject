<?php

namespace App\Actions\Core\v1\Auth\Otp;

use App\Services\Auth\EskizService;
use App\Traits\ResponseTrait;
use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

class SendAction
{
    use ResponseTrait;

    protected EskizService $eskizService;

    public function __construct()
    {
        $this->eskizService = new EskizService();
    }

    /**
     * Summary of __invoke
     * @param array $user
     * @return JsonResponse
     */
    public function __invoke(array $user): JsonResponse
    {
        $ttl = 120;
        $code = rand(100000, 999999);

        if (Cache::has('otp_verification_' . $user['phone'])) {
            $ttl_left = Redis::ttl(config('cache.prefix') . 'otp_verification_' . $user['phone']);


            return static::toResponse(
                code: 400,
                message: trans('auth.otp.exists'),
                data: [
                    'otp_lifetime' => $ttl,
                    'time_remaining' => $ttl_left
                ]
            );
        }

        $this->eskizService->send(
            phone: $user['phone'],
            // message: __('auth.otp.message', ['code' => $code])
            message: "Bu Eskiz dan test"
        );

        Cache::set('otp_verification_' . $user['phone'], $code, $ttl);

        return static::toResponse(
            message: trans('auth.otp.success'),
            data: [
                'code' => $code,
                'otp_lifetime' => $ttl,
            ]
        );
    }
}
