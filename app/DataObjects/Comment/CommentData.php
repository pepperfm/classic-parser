<?php

declare(strict_types=1);

namespace App\DataObjects\Comment;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CommentData extends Data
{
    public function __construct(
        public int $id,
        public int $postId,
        public string $email,
        public string $body
    ) {
    }
}
