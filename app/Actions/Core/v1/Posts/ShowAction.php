<?php

namespace App\Actions\Core\v1\Posts;

use App\Exceptions\ApiResponseException;
use App\Http\Resources\Core\v1\Posts\PostResource;
use App\Models\Post;
use App\Traits\ResponseTrait;
use App\Actions\Traits\GenerateKeyCacheTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ShowAction
{
    use ResponseTrait, GenerateKeyCacheTrait;
    /**
     * Summary of __invoke
     * @param int $id
     * @throws \App\Exceptions\ApiResponseException
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $data = Cache::remember('post.show' . $this->generateKey(), now()->addDay(), function () use ($id) {
                return Post::findOrFail($id);
            });

            return static::toResponse(
                data: new PostResource($data)
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException("Post not found", 404);
        }
    }
}