<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ClustersTableSeeder::class,
            PostsTableSeeder::class,
            ModulesTableSeeder::class,
            AnswersTableSeeder::class,
        ]);
    }
}
