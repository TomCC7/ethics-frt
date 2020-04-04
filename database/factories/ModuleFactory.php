<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Content\Module::class, function (Faker $faker) {
    $types = App\Content\Module::getType();
    switch ($faker->randomElement($types)) {
        case 'text':
            return [
                'type' => 'text',
                'content' => json_encode(['body' => $faker->text]),
            ];
            break;
        case 'choice':
            return [
                'type' => 'choice',
                'content' => choiceContent($faker),
            ];
            break;
        case 'filling':
            return [
                'type' => 'filling',
                'content' => json_encode([
                    'question' => $faker->sentence(),
                    'short' => $faker->boolean
                ]),
            ];
            break;
        default:
            return [
                'type' => 'error',
            ];
    }
});

function choiceContent(Faker $faker)
{
    $subtypes = app(App\Content\Module::class)->subtypes('choice');
    $choices = [$faker->word, $faker->word, $faker->word, $faker->word];
    $content = [
        'question' => $faker->sentence,
        'options' => $choices,
        'subtype' => $faker->randomElement($subtypes),
    ];
    return json_encode($content);
}

function selectContent(Faker $faker)
{
    $options = [];
    for ($i = 0; $i < $faker->numberBetween(2, 10); $i++) {
        array_push($options, $faker->word);
    }
    $content = [
        'question' => $faker->sentence,
        'options' => $options,
    ];
    return json_encode($content);
}
