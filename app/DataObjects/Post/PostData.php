<?php

declare(strict_types=1);

namespace App\DataObjects\Post;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use App\DataObjects\Comment\CommentData;

#[MapName(SnakeCaseMapper::class)]
class PostData extends Data
{
    public function __construct(
        public int $id,
        public int $userId,
        public string $title,
        public string $body,
        #[DataCollectionOf(CommentData::class)]
        public DataCollection|Optional $comments
    ) {
    }
}
