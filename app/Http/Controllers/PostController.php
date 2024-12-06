<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    public function post(): JsonResponse{

        $data = Cache::remember('posts', now()->addMinute(), function () {
            $items = Post::query();
            return $items->paginate(perPage: 10, page: 1);
        });

        return response()->json([
            'count' => $data->total(),
            'ttl' => Redis::ttl(config('cache.prefix') . 'posts'),
            'data' => $data->items()
        ]);

    }
}
