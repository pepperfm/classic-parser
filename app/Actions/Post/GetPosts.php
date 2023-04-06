<?php

declare(strict_types=1);

namespace App\Actions\Post;

use Illuminate\Http\Request;
use Spatie\LaravelData\Contracts\DataCollectable;
use App\DataObjects\Post\PostData;
use App\Models\Post;

class GetPosts
{
    /**
     * @return DataCollectable<array-key, \App\DataObjects\Post\PostData>
     */
    public function handle(Request $request): DataCollectable
    {
        $postsQ = Post::query()->select(['id', 'user_id', 'title', 'body']);
        if ($request->boolean('with_comments')) {
            $postsQ->with('comments:id,post_id,name,email,body');
        }

        return PostData::collection($postsQ->get());
    }
}
