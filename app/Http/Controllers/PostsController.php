<?php

namespace App\Http\Controllers;

use App\Collected\AnswerRecord;
use Illuminate\Http\Request;
use App\Content\Cluster;
use App\Content\Post;
use App\Handlers\MarkdownHandler;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\App;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, Cluster $cluster, Post $post)
    {
        // get the record of the user of this post
        $answer_record = $post->userRecord(Auth::id())->first();
        // avoid cluster/post mismatch
        $post = $cluster->posts()->where('id', $post->id)->first();

        // check if there's unanswered prerequisite(when not admin)
        if (!Auth::user()->is_admin && isset($post->prerequisite)) {
            $preq = Post::Find($post->prerequisite);
            $preq_answer = AnswerRecord::FindUnique(Auth::id(), $preq->id)->first();
            // check if the answer exists
            if (!$preq_answer) {
                return redirect()->route('posts.show', ['cluster' => $preq->cluster->slug, 'post' => $preq->id])
                    ->with('info', 'You have unfinished prerequisite(s), redirected here');
            }
        }
        // check if the post exists
        if ($post) {
            return view('posts.show', compact('post', 'answer_record'));
        } else {
            App::abort(404);
        }
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
        $post = Post::make([
            'title' => $request->title,
        ]);
        $post->cluster_id = $request->cluster_id;
        $post->save();
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Post'.$post->name.' created successfully!');
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->toArray());
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Post '.$post->name.' is updated successfully!');
    }

    public function destroy(Post $post)
    {
        // delete the post itself
        $post->delete();

        return redirect()->route(clusters.show, [
            'cluster' => $post->cluster->slug,
        ])
            ->with('success', 'Post '.$post->name.' is deleted!');
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
