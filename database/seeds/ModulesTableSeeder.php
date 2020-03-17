<?php

use Illuminate\Database\Seeder;
use App\Content\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create an instance of class faker
        $faker = app(Faker\Generator::class);
        $modules = factory(Module::class)
            ->times(100)
            ->make()// create instances without inserting into database
            ->each(function ($module)
            use ($faker) {
                $module->post_id = $faker->numberBetween(1,10);
            });
        Module::insert($modules->toArray());
    }
}
