<?php

namespace App\Http\Controllers;

use App\Collected\AnswerRecord;
use Illuminate\Http\Request;
use App\Content\Cluster;
use App\Content\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, Cluster $cluster, Post $post)
    {
        // take option based on the status of the post
        if (!Auth::user()->isAdmin()) {
            switch ($post->status) {
                case 'unreleased':
                    return view('posts.show_unreleased');
                    break;
                default:
                    break;
            }
        }
        // get the record of the user of this post
        $answer_record = $post->userRecord(Auth::id())->first();
        // get the answers of the user
        $answers = [];
        if ($answer_record) {
            foreach ($answer_record->answers as $answer) {
                $answers[$answer->module_id] = $answer->getContent();
            }
        }
        // avoid cluster/post mismatch
        $post = $cluster->posts()->where('id', $post->id)->first();

        // check if there's unfinished prerequisite, admins are not affected
        if (!Auth::user()->is_admin && isset($post->prerequisite)) {
            $preq = Post::Find($post->prerequisite);
            $preq_answer = AnswerRecord::FindUnique(Auth::id(), $preq->id)->first();
            // check if the answer exists
            if (!$preq_answer) {
                return redirect()
                    ->route('posts.show', ['cluster' => $preq->cluster->slug, 'post' => $preq->slug])
                    ->with('warning', 'Before viewing that post, please finish this first.');
            }
        }
        // check if the post exists
        if ($post) {
            return view('posts.show', compact('post', 'answer_record', 'answers'));
        } else {
            App::abort(404);
        }
    }

    public function store(PostRequest $request)
    {
        Gate::authorize('admin');
        $post = Post::make([
            'title' => $request->title,
        ]);
        $post->cluster_id = $request->cluster_id;
        $post->save();
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Post' . $post->name . ' created successfully!');
    }

    public function update(PostRequest $request, Post $post)
    {
        Gate::authorize('admin');
        $post->update($request->toArray());
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Post ' . $post->name . ' is updated successfully!');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('admin');
        // delete the post itself
        $post->delete();

        return redirect()->route('clusters.show', [
            'cluster' => $post->cluster->slug,
        ])
            ->with('success', 'Post ' . $post->name . ' is deleted!');
    }
}
