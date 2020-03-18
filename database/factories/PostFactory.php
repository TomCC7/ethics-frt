<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $sentence=$faker->sentence;
    return [
        'title' => $sentence,
        'slug' => NametoSlug($sentence),
    ];
});
