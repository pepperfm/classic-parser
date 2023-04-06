<?php

declare(strict_types=1);

namespace App\Actions\Post;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;
use App\DataObjects\Post\PostData;

class ShowPost
{
    /**
     * @param \App\Models\Post $post
     *
     * @return \Spatie\LaravelData\Contracts\DataObject<array-key, PostData>
     */
    public function handle(Model $post): DataObject
    {
        return PostData::from($post);
    }
}
