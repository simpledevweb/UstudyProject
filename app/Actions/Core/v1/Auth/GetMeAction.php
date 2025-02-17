<?php

namespace App\Actions\Core\v1\Auth;

use App\Http\Resources\Core\v1\Auth\GetMeResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class GetMeAction
{
    use ResponseTrait;
    public function __invoke(): JsonResponse
    {
        return static::toResponse(
            message: "User retrieved successfully",
            data: new GetMeResource(auth()->user())
        );
    }
}