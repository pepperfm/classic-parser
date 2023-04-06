<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Post\{GetPosts, ShowPost};
use App\Contracts\ResponseContract;
use App\Models\Post;

class PostController
{
    public function __construct(public ResponseContract $json)
    {
    }

    public function index(Request $request, GetPosts $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'posts' => $action->handle($request),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->json->stored([]);
    }

    public function show(Post $post, ShowPost $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'post' => $action->handle($post),
        ]);
    }

    public function update(Request $request, Post $post): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        return $this->json->deleted([]);
    }
}
