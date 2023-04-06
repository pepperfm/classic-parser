<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => [
                'street' => $this->faker->streetAddress(),
                'suite' => $this->faker->address(),
                'city' => $this->faker->city(),
                'zipcode' => $this->faker->postcode(),
                'geo' => [
                    'lat' => $this->faker->latitude,
                    'lng' => $this->faker->longitude,
                ],
            ],
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->word(),
            'company' => [
                'name' => $this->faker->name(),
                'catchPhrase' => $this->faker->name(),
                'bs' => $this->faker->name(),
            ],
        ];
    }
}
