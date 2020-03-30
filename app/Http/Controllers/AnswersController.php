<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collected\Answer;
use App\Content\Cluster;
use App\Content\Post;
use App\Content\Module;
use App\Collected\AnswerRecord;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnswerRequest;

class AnswersController extends Controller
{
    /**
     *
     * Store the answers of the modules
     */
    public function store(AnswerRequest $request)
    {
        $answers = $request->answers;
        $types = $request->types;
        // check if there's question answered
        if (!isset($answers)) {
            return back()->with('danger', "No question in the post!");
        }
        // store the answers
        foreach ($answers as $module_id => $request_answer) {
            // convert to int
            if ($types[$module_id] != 'filling') {
                if (is_array($request_answer)) {
                    $request_answer = array_intval($request_answer);
                } elseif (!is_int($request_answer)) {
                    $request_answer = intval($request_answer);
                }
            }
            $answer = Answer::Create(['content' => json_encode($request_answer)]);
            $answer->module_id = intval($module_id);
            $answer->user_id = Auth::id();
            $answer->save();
        }
        // create an answerrecord
        $post = Post::Find($request->post_id);
        // if empty, then create a record
        if (empty($post->userRecord(Auth::id())->get()->toArray())) {
            $record = AnswerRecord::Make();
            $record->post_id = $post->id;
            $record->user_id = Auth::id();
            $record->batch = 1;
            $record->save();
        } else {
            $record = AnswerRecord::FindUnique(Auth::id(), $post->id)->first();
            $record->batch += 1;
            $record->save();
        }
        return back()->with('success', "You've submitted your answer!");
    }

    /**
     *
     * Show the answer list
     */
    public function index()
    {
        $clusters = Cluster::All();
        return view('answers.index', compact('clusters'));
    }

    /**
     * Show the answers of a given post
     */
    public function show(Cluster $cluster, Post $post)
    {
        $modules = $post->modules()->question()->with('post', 'answers')->get();
        return view('answers.show', compact('post', 'modules'));
    }
}
