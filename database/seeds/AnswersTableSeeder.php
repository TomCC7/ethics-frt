<?php

use Illuminate\Database\Seeder;
use App\Content\Post;
use App\Collected\Answer;
use App\Collected\AnswerRecord;

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
        $post = Post::Find(1);
        // create answer record
        for ($i=0;$i<10;$i++)
        {
            $record=AnswerRecord::make();
            $record->post_id=1;
            $record->user_id=$i+1;
            $record->batch=1;
            $record->save();
        }
        foreach ($post->modules as $module) {
            $answers = factory(App\Collected\Answer::class)->times(100)
                ->make([
                    'module_id' => $module->id,
                ]);
            $answers->each(function ($answer)
            use ($faker, $module) {
                // give user_id
                $answer->answer_record_id = $faker->numberBetween(1, 10);
                // give content based on the type
                switch ($module->type) {
                    case 'text':
                        $answer->delete();
                        break;
                    default:
                        $answer->content = json_encode($faker->sentence);
                        break;
                }
            });
            Answer::insert($answers->toArray());
        }
        Answer::Where('content', '"seed"')->delete();
    }
}
