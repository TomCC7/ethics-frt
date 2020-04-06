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
        $post->slug = NametoSlug($post->title);
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Content\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        // delete all the modules of the cluster
        $post->modules()->forceDelete();
    }
}
