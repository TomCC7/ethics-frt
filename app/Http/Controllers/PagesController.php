<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PagesController extends Controller
{
    public function frontpage()
    {
        return view('pages.frontpage');
    }
}
