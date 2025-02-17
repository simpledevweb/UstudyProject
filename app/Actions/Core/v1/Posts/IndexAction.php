<?php

namespace App\Actions\Core\v1\Posts;

use App\Dto\Core\v1\Posts\IndexDto;
use App\Http\Resources\Core\v1\Posts\PostCollection;
use App\Models\Post;
use App\Traits\ResponseTrait;
use App\Actions\Traits\GenerateKeyCacheTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class IndexAction
{
    use ResponseTrait, GenerateKeyCacheTrait;
    public function __invoke(IndexDto $dto): JsonResponse
    {
        $data = Cache::remember('posts' . $this->generateKey(), now()->addDay(), function () use ($dto) {
            $items = Post::query();

            if ($dto->search) {
                $items
                    ->where('title', 'LIKE', '%' . $dto->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $dto->search . '%');
            }

            if ($dto->from) {
                $items->whereBetween('created_at', [$dto->from, $dto->to]);
            }

            switch ($dto->sort) {
                case "popular":
                    $items
                        ->orderByDesc('view')
                        ->orderByDesc('shared');
                    break;
                case "recommended":
                    $items
                        ->where('recommended', '=', true);
                    break;
                default:
                    $items
                        ->orderByDesc('created_at');
            }

            return $items->paginate(perPage: $dto->perPage, page: $dto->page);
        });

        return static::toResponse(
            data: [
                'items' => new PostCollection($data),
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'last_page' => $data->lastPage(),
                    'total' => $data->total(),
                ]
            ],
        );
    }
}