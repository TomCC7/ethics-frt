<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;

class ClusterController extends Controller
{
    public function list() {
        $clusters = Cluster::all();
        return view('clusters.list')->with(['clusters'=>$clusters]);
    }
}
