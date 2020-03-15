<?php

use Illuminate\Database\Seeder;
use App\Content\Post;
use App\Content\Cluster;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cluster_ids = Cluster::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $posts = factory(Post::class)
            ->times(100)
            ->make()
            ->each(function ($post)
            use ($cluster_ids, $faker) {
                $post->cluster_id = $faker->randomElement($cluster_ids);
            });
        Post::insert($posts->toArray());
    }
}
