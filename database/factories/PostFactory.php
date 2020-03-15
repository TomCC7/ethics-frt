<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
    ];
});
