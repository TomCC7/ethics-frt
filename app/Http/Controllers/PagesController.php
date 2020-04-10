<?php

namespace App\Http\Controllers;

use App\Content\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PagesController extends Controller
{
    public function frontpage()
    {
        //// if registration not completed,redirect to registration
        $user = User::Find(Auth::id());
        if (
           Auth::user() &&
           !$user->is_admin &&
           !$user->isRegistered()
        ) {
            $post=Post::Find(5);
           session()->flash('dangerous', 'Please finish registration!');
           return redirect()->route('posts.show',[$post->cluster->slug,$post->slug]);
        }
        //// check if the user has completed registration
        return view('pages.frontpage');
    }
}
