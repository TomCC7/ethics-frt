<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Collected\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'content' => json_encode('seed'),
    ];
});
