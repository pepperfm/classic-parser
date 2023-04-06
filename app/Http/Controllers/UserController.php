<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ResponseContract;
use App\Actions\User\{GetUsers, ShowUser};
use App\Models\User;

class UserController
{
    /**
     * @param \App\Http\APIBaseResponder $json
     */
    public function __construct(public ResponseContract $json)
    {
    }

    public function index(Request $request, GetUsers $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'users' => $action->handle($request),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->json->stored([]);
    }

    public function show(User $user, ShowUser $action): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'user' => $action->handle($user),
        ]);
    }

    public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->json->deleted([]);
    }
}
