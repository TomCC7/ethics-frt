<?php

namespace App\Observers;

use App\Collected\Answer;
use Illuminate\Support\Facades\Auth;
use App\User;
class AnswerObserver
{
    public function saved(Answer $answer)
    {
        $user=User::Find(Auth::id());
        if (!$user->isRegistered() && $user->postRecord(5)!==null)
        {
            Auth::user()->is_registered=true;
            Auth::user()->save();
        }
    }
}
