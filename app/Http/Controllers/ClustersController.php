<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ClustersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     *
     * Show all clusters
     * @return view
     */
    public function index()
    {
        $clusters = Cluster::all();
        return view('clusters.index')->with(['clusters' => $clusters]);
    }

    /**
     *
     * show all posts of a cluster
     * @return view
     */
    public function show(Request $request, Cluster $cluster)
    {
        $clusters = Cluster::all();
        $selectedCluster = $cluster;
        return view('clusters.index', compact('clusters', 'selectedCluster'));
        //Browse posts in a subview of the cluster list
    }

    /**
     * store a cluster
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');
        $request->validate(['name' => 'required|max:100']);
        Cluster::Create(['name' => $request->name]);
        return back()->with('success', 'Cluster created successfully!');
    }

    /**
     * update a cluster
     */
    public function update(Request $request, Cluster $cluster)
    {
        Gate::authorize('admin');
        $request->validate(['name' => 'required|max:100|unique:clusters']);
        $cluster->update(['name' => $request->name]);
        return back()->with('success', 'Cluster updated successfully!');
    }

    /**
     * destroy a cluster
     */
    public function destroy(Request $request, Cluster $content)
    {
        Gate::authorize('superadmin');
        // validate the confirmation
        $request->validate(
            ['confirmation' => ['required', Rule::in($content->name)]],
            ['confirmation.in' => 'Please fill in the right name!']
        );
        // delete the cluster
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Cluster has been deleted!');
    }
}
