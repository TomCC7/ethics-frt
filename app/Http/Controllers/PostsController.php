<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;
use App\Content\Post;
use App\Content\Module;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(int $clusterID)
    {
        $clusters = Cluster::all();
        $posts = Cluster::find($clusterID)->posts;
        return view('clusters.list', compact('posts', 'clusters'));
    }

    public function create(Post $post)
    {
        $clusters = Cluster::all();
        return view('posts.create_edit', compact('post', 'clusters')); //share one view
    }

    public function edit(Post $post)
    {
        $clusters = Cluster::all();
        return view('posts.create_edit', compact('post', 'clusters')); //share one view
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        Post::create([
            'cluster_id' => $request->cluster_id,
            'title' => $request->title,
        ]);
        return redirect()->route('root')->with('success','Post created successfully!');
    }

    public function update(Post $post, Request $request)
    {
    }

    public function destroy()
    {
    }
}
