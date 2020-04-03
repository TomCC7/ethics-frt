<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PagesController extends Controller
{
    public function frontpage()
    {
        // if registration not completed,redirect to registration
        $user = User::Find(Auth::id());
        if (
            Auth::user() &&
            !$user->is_admin &&
            !$user->postRecord(5)->first()
        ) {
            session()->flash('warning', 'Please finish registration!');
            return redirect()->to('/contents/Register-Info/Belief-Information');
        }
        // check if the user has completed registration
        return view('pages.frontpage');
    }
}
