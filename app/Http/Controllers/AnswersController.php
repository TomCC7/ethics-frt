<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collected\Answer;
use App\Content\Cluster;
use App\Content\Post;
use App\Content\Module;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     *
     * Store the answers of the modules
     */
    public function store(Request $request)
    {
        // dd($request);
        $answers = $request->answers;
        $types = $request->types;
        foreach ($answers as $module_id => $request_answer) {
            // convert to int
            if ($types[$module_id] != 'filling') {
                if (is_array($request_answer)) {
                    $request_answer = array_map(function ($item) {
                        return intval($item);
                    }, $request_answer);
                } elseif (is_int($request_answer)) {
                    $request_answer = intval($request_answer);
                }
            }
            $answer = Answer::Create(['content' => json_encode($request_answer)]);
            $answer->module_id = intval($module_id);
            $answer->user_id = Auth::id();
            $answer->save();
        }
        return back()->with('success', "You've submitted your answer!");
    }

    /**
     *
     * Show the answer list
     */
    public function index()
    {
        $clusters=Cluster::All();
        return view('answers.index',compact('clusters'));
    }

    /**
     * Show the answers of a given post
     */
    public function show(Cluster $cluster,Post $post)
    {
        $modules=$post->modules()->question()->with('post','answers')->get();
        return view('answers.show',compact('post','modules'));
    }
}
