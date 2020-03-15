<?php

use Illuminate\Database\Seeder;
use App\Content\Cluster;

class ClustersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cluster::class)->times(5)->create();
    }
}
