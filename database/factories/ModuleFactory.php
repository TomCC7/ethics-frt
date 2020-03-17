<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Content\Module;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'type' => 'text',
        'content' => ' {"body": " ' . $faker->text . ' "} ',
    ];
});
