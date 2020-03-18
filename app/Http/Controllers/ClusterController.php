<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;

class ClusterController extends Controller
{
    /**
     *
     * Show all clusters
     * @return view
     */
    public function index() {
        $clusters = Cluster::all();
        return view('clusters.list')->with(['clusters'=>$clusters]);
    }

    /**
     *
     * show all posts of a cluster
     * @return view
     */
    public function show(Cluster $currentCluster)
    {
        $clusters = Cluster::all();
        return view('clusters.list', compact('clusters', 'currentCluster'));
            //Browse posts in a subview of the cluster list
    }
}
