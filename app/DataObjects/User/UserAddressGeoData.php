<?php

declare(strict_types=1);

namespace App\DataObjects\User;

use Spatie\LaravelData\Data;

class UserAddressGeoData extends Data
{
    public function __construct(
        public string $lat,
        public string $lng
    ) {
    }
}
