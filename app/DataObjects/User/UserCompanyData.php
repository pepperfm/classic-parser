<?php

declare(strict_types=1);

namespace App\DataObjects\User;

use Spatie\LaravelData\Data;

class UserCompanyData extends Data
{
    public function __construct(
        public string $name,
        public string $catchPhrase,
        public string $bs
    ) {
    }
}
