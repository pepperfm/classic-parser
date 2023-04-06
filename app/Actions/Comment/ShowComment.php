<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataObject;
use App\DataObjects\Comment\CommentData;

class ShowComment
{
    /**
     * @param \App\Models\Comment $comment
     *
     * @return \App\DataObjects\Comment\CommentData
     */
    public function handle(Model $comment): DataObject
    {
        return CommentData::from($comment);
    }
}
