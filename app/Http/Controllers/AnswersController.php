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
     * Store or update the answers of the modules
     */
    public function storeOrUpdate(AnswerRequest $request, Post $post)
    {
        // get the answers of the modules
        $answers = $request->answers;

        // check if there's question answered
        if (!isset($answers)) {
            return back()->with('danger', "No question in the post!");
        }

        // check if all questions are in the post
        if (!$this->modulesInPost(array_keys($answers), $post)) {
            return back()->with('danger', 'Something unexpected happened');
        }

        // Handle the answer record
        $record = $this->handleRecord($post);

        if ($record->batch === 1) // indicate creating
        {
            // store the answers
            foreach ($answers as $module_id => $request_answer) {
                // convert to int
                $content = $this->handleAnswer($module_id, $request_answer);
                $answer = Answer::Make(['content' => $content]);
                $answer->module_id = intval($module_id);
                $answer->answer_record_id = $record->id;
                $answer->save();
            }
        } else {
            // update the answers
            foreach ($answers as $module_id => $request_answer) {
                // convert to int
                $content = $this->handleAnswer($module_id, $request_answer);
                if ($record->answerOfModule($module_id)) {
                    $record->answerOfModule($module_id)->update(['content' => $content]);
                } else {
                    $answer = Answer::Make(['content' => $content]);
                    $answer->module_id = intval($module_id);
                    $answer->answer_record_id = $record->id;
                    $answer->save();
                }
            }
        }

        // flash the message to the user
        session()->flash('info', $post->message);
        // redirect to the next post or send the user back
        if ($post->redirect) {
            return redirect()
                ->route('posts.show', [
                    "cluster" => Cluster::find($post->cluster_id)->slug,
                    "post" => Post::find($post->redirect)->slug] )
                    ->with('success', 'Answers submitted.');
        } else {
            return back()->with('success', 'Answers submitted.');
        }
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
        $modules = $post->modules()->question()->with('answers.answerRecord.user')->get();
        return view('answers.show', compact('post', 'modules'));
    }

    /**
     * check if all modules are in the post
     * @param array $answers
     * @param \App\Content\Post $post
     * @return bool
     */
    protected function modulesInPost($ids, $post)
    {
        // get the model with id loaded
        $modules = $post->modules()->get();
        $module_ids = [];
        // dump the ids into a new array
        foreach ($modules as $module) {
            $module_ids[] = $module->id;
        }
        // determine if every answers' module id are in the array
        foreach ($ids as $id) {
            if (!in_array($id, $module_ids)) {
                return false;
            }
        }
        // if not, return true
        return true;
    }

    /**
     * modify the type of the answer and compact it to json
     * @param int $module_id
     * @param array/string $request_answer
     * @return string->json
     */
    protected function handleAnswer($module_id, $request_answer)
    {
        // $module = Module::Find($module_id);
        // switch ($module->type) {
        //     case 'choice':
        //         if (is_array($request_answer)) {
        //             $request_answer = array_intval($request_answer);
        //         } else {
        //             $request_answer = intval($request_answer);
        //         }
        //         break;
        //     default:
        //         break;
        // }
        return json_encode($request_answer);
    }

    /**
     * update or store the answerRecord and return its id
     * @param \App\Content\Post $post
     * @return \App\Collected\AnswerRecord
     */
    protected function handleRecord($post)
    {
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
        return $record;
    }
}
