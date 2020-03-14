<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $id='51'. $faker->numberBetween(0,9) . $faker->numberBetween(100000000,999999999);
    $updated_at=$faker->dateTimeThisYear();
    $created_at=$faker->dateTimeThisYear($max=$updated_at);

    return [
        'name' => $faker->name,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'section_number' => $faker->numberBetween(1,10),
        'semester' => '19FA',
        'student_id' => $id,
        'is_admin' => 0,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$30ScEh54PoA1uKLIjaEQVuqjZnBCn9g/J.FoTQW6LL4a8gmJ3fEo6', // 123456
        'remember_token' => Str::random(10),
    ];
});
