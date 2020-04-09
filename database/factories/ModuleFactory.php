<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Content\Module;

$factory->define(App\Content\Module::class, function (Faker $faker) {
    $module=app(Module::class);
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
                    'subtype' => $faker->randomElement($module->Subtypes('filling')),
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
