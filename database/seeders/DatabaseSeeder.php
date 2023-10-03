<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\CareGoal\Model\CareGoal;
use Domain\CarePlan\Model\CarePlan;
use Domain\User\Model\User;
use Domain\User\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1000)->create();
        User::factory()->create([
            'id' => '994a3a54-7307-41a2-8e1b-37b3c394b72f',
            'firstName' => 'Frederick',
            'lastName' => 'Willems',
            'email' => 'frederick@codetopia.be'
        ]);
    }
}
