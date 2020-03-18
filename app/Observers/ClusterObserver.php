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
    public function saving(Cluster $cluster)
    {
        $cluster->slug=NametoSlug($cluster->name);
    }
}
