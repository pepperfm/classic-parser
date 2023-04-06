<?php

declare(strict_types=1);

namespace App\Actions\User;

use Illuminate\Http\Request;
use Spatie\LaravelData\Contracts\DataCollectable;
use App\DataObjects\User\UserData;
use App\Models\User;

class GetUsers
{
    /**
     * @param Request $request
     *
     * @return DataCollectable<array-key, \App\DataObjects\User\UserData>
     */
    public function handle(Request $request): \Illuminate\Contracts\Support\Responsable
    {
        $usersQ = User::query()->select([
            'id', 'name', 'username', 'email',
            'address', 'phone', 'website', 'company',
        ]);
        if ($request->boolean('with_posts')) {
            $usersQ->with('posts:id,user_id,title,body');
        }

        return UserData::collection($usersQ->get());
    }
}
