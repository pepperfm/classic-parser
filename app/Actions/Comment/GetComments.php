<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Spatie\LaravelData\Contracts\DataCollectable;
use App\DataObjects\Comment\CommentData;
use App\Models\Comment;

class GetComments
{
    /**
     * @return DataCollectable<array-key, \App\DataObjects\Comment\CommentData>
     */
    public function handle(): DataCollectable
    {
        $comments = Comment::query()->select(['id', 'post_id', 'name', 'email', 'body'])->get();

        return CommentData::collection($comments);
    }
}
