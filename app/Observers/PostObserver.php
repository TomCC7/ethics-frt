<?php

namespace App\Observers;

use App\Content\Post;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
class PostObserver
{
    /**
     *
     * Handle the post "saving" event.
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        $post->slug=NametoSlug($post->title);
    }

    /**
     * Handle the post "created" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
