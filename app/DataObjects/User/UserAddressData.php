<?php

declare(strict_types=1);

namespace App\DataObjects\User;

use Spatie\LaravelData\Data;

class UserAddressData extends Data
{
    public function __construct(
        public string $street,
        public string $suite,
        public string $city,
        public string $zipcode,
        public UserAddressGeoData $geo
    ) {
    }
}
