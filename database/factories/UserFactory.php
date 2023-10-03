<?php

namespace Database\Factories;

use Domain\User\Model\User;
use Domain\User\UserType;
use Faker\Provider\nl_BE\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $this->faker->addProvider(Person::class);

        return [
            'type' => fake()->randomElement(UserType::values()),
            'nationalId' => $this->faker->rrn(),
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
