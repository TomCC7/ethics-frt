<?php

namespace App\Providers;

use App\Observers\AnswerObserver;
use App\Observers\ClusterObserver;
use App\Observers\ModuleObserver;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Content\Post::observe(PostObserver::class);
        \App\Content\Cluster::observe(ClusterObserver::class);
        \App\Content\Module::observe(ModuleObserver::class);
        \App\Collected\Answer::observe(AnswerObserver::class);
    }
}
