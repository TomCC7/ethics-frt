<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collected\AnswerRecord;
use Illuminate\Support\Facades\Gate;

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
        return back()->with('success','You\'ve deleted this answer');
    }
}
