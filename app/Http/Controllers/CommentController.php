<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Comment\{GetComments, ShowComment};
use App\Contracts\ResponseContract;
use App\Models\Comment;

class CommentController
{
    /**
     * @param \App\Http\APIBaseResponder $json
     */
    public function __construct(public ResponseContract $json)
    {
    }

    public function index(GetComments $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'comments' => $action->handle(),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->json->stored([]);
    }

    public function show(Comment $comment, ShowComment $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'comment' => $action->handle($comment),
        ]);
    }

    public function update(Request $request, Comment $comment): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    public function destroy(Comment $comment): \Illuminate\Http\JsonResponse
    {
        return $this->json->deleted([]);
    }
}
