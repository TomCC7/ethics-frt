<?php

namespace App\Observers;

use App\Content\Cluster;

class ClusterObserver
{
    /**
     *
     * Action after the Cluster was saved
     * @return null
     */
    public function saving (Cluster $cluster)
    {
        $cluster->slug = NametoSlug($cluster->name);
    }

    /**
     * Actions when the cluster is being deleted
     */
    public function deleting (Cluster $cluster)
    {
        // delete all the posts of the cluster
        foreach($cluster->posts as $post)
        {
            $post->forceDelete();
        }
    }
}
