<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collected\AnswerRecord;
use Illuminate\Support\Facades\Gate;
use App\Content\Post;
use Illuminate\Validation\Rule;

class AnswerRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Gate::authorize('admin');
    }
    public function destroy(AnswerRecord $answerrecord)
    {
        Gate::authorize('superadmin');
        $answerrecord->delete();
        return back()->with('success', 'You\'ve deleted this answer');
    }

    public function destroyAll(Request $request, Post $post)
    {
        Gate::authorize('superadmin');
        $this->validate(
            $request,
            ['confirmation' => ['required', Rule::in('I understand')]],
            ['confirmation.in' => 'Please type in the right confirmation!']
        );
        foreach ($post->answerRecords as $record) {
            $record->delete();
        }
        // $post->answerRecords()->delete();
        return back()->with('success', 'all records have been deleted');
    }
}
