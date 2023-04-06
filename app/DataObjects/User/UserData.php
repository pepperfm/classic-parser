<?php

declare(strict_types=1);

namespace App\DataObjects\User;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;
use App\DataObjects\Post\PostData;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $username,
        public string $email,
        public UserAddressData $address,
        public string $phone,
        public string $website,
        public UserCompanyData $company,
        #[DataCollectionOf(PostData::class)]
        public DataCollection|Optional $posts
    ) {
    }
}
