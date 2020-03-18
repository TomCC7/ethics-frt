<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Cluster;
use App\Content\Post;
use App\Content\Module;
use App\Handlers\MarkdownHandler;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Cluster $cluster, Post $post)
    {
        return view('posts.show', compact('post'));
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

    public function store(PostRequest $request)
    {
        $post = Post::create([
            'cluster_id' => $request->cluster_id,
            'title' => $request->title,
        ]);
        Module::createByType('text', $request, $post->id);
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Post created successfully!');
    }

    public function update(Post $post, Request $request)
    {
    }

    public function destroy(Post $post)
    {
        // delete the modules of the post
        $post->modules->each(function ($module) {
            $module->delete();
        });
        // delete the post itself
        $post->delete();

        return back()->with('success', 'post has been deleted!');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // initialize the data with false value
        $data = [
            'success'   => false,
            'msg'       => 'upload failed!!',
            'file_path' => ''
        ];
        // determine whether there's files uploaded
        if ($file = $request->upload_file) {
            // save the file
            $result = $uploader->save($file, 'posts', Auth::id());
            // if success
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "uploaded!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}
