<?php

use Illuminate\Database\Seeder;
use App\Content\Post;
use App\Collected\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $post = Post::first();
        foreach ($post->modules as $module) {
            $answers = factory(App\Collected\Answer::class)->times(100)
                ->make([
                    'user_id' => $faker->numberBetween(1, 10),
                    'module_id' => $module->id,
                ]);
            $answers->each(function ($answer)
            use ($faker, $module) {
                // give content based on the type
                switch ($module->type) {
                    case 'text':
                        $answer->delete();
                        break;
                    case 'filling':
                        $answer->content = json_encode($faker->sentence);
                        break;
                    case 'single-choice':
                        $answer->content = json_encode($faker->numberBetween(1, 4));
                        break;
                    case 'multiple-choice':
                        $content = $faker->randomElements([1, 2, 3, 4], $faker->numberBetween(0, 4));
                        $answer->content = json_encode($content);
                        break;
                    default:
                        break;
                }
            });
            Answer::insert($answers->toArray());
        }
        Answer::Where('content','"seed"')->delete();
    }
}
