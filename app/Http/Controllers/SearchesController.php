<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchesController extends Controller
{
    public function user(Request $request)
    {
        // dd($request);
        $users=User::Search($request->index)->paginate(20);
        return view('users.index',compact('users'));
    }
}
