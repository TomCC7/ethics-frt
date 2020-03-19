<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Content\Module::class, function (Faker $faker) {
    $types = ['text', 'single-choice', 'multiple-choice', 'filling'];
    switch ($faker->randomElement($types)) {
        case 'text':
            return [
                'type' => 'text',
                'content' => json_encode(['body' => $faker->text]),
            ];
            break;
        case 'single-choice':
            return [
                'type' => 'single-choice',
                'content' => choiceContent($faker),
            ];
            break;
        case 'multiple-choice':
            return [
                'type' => 'multiple-choice',
                'content' => choiceContent($faker),
            ];
            break;
        case 'filling':
            return [
                'type' => 'filling',
                'content' => json_encode(['question' => $faker->sentence(),
                                          'short' => $faker->boolean]),
            ];
            break;
        default:
            return[
                'type' => 'error',
            ];
    }
});

function choiceContent(Faker $faker)
{
    $choices = [$faker->word, $faker->word, $faker->word, $faker->word];
    $content = [
        'question' => $faker->sentence,
        'choices' => $choices
    ];
    return json_encode($content);
}
