<?php

namespace Database\Factories;

use Domain\CareGoal\Model\CareGoal;
use Illuminate\Database\Eloquent\Factories\Factory;

class CareGoalFactory extends Factory
{
    protected $model = CareGoal::class;

    public function definition(): array
    {
        return [
            'title' => fake()->text(60),
            'description' => fake()->paragraph,
        ];
    }
}
