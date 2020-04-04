<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;
use Illuminate\Validation\Rule;

class ClustersController extends Controller
{
    /**
     *
     * Show all clusters
     * @return view
     */
    public function index()
    {
        $clusters = Cluster::all();
        return view('clusters.list')->with(['clusters' => $clusters]);
    }

    /**
     *
     * show all posts of a cluster
     * @return view
     */
    public function show(Request $request, Cluster $content)
    {
        $clusters = Cluster::all();
        return view('clusters.list', compact('clusters', 'content'));
        //Browse posts in a subview of the cluster list
    }

    /**
     * store a cluster
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:100']);
        Cluster::Create(['name' => $request->name]);
        return back()->with('success', 'Cluster created successfully!');
    }

    /**
     * update a cluster
     */
    public function update(Request $request, Cluster $cluster)
    {
        $request->validate(['name' => 'required|max:100|unique:clusters']);
        $cluster->update(['name' => $request->name]);
        return back()->with('success', 'Cluster updated successfully!');
    }

    /**
     * destroy a cluster
     */
    public function destroy(Request $request, Cluster $content)
    {
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
