<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content\Cluster;
use Faker\Generator as Faker;

$factory->define(Cluster::class, function (Faker $faker) {
    $name=$faker->word;
    return [
        'name' => $name,
        'slug' => NametoSlug($name),
    ];
});
