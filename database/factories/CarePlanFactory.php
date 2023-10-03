<?php

namespace Database\Factories;

use Domain\CarePlan\CarePlanStatus;
use Domain\CarePlan\Model\CarePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarePlanFactory extends Factory
{
    protected $model = CarePlan::class;

    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(CarePlanStatus::values()),
        ];
    }
}
