<?php

declare(strict_types=1);

namespace App\Actions\User;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;
use App\DataObjects\User\UserData;

class ShowUser
{
    /**
     * @param \App\Models\User $user
     *
     * @return \App\DataObjects\User\UserData
     */
    public function handle(Model $user): DataObject
    {
        $user->load('posts:id,user_id,title,body');

        return UserData::from($user);
    }
}
