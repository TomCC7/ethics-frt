<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(User $user)
    {
        Gate::authorize('admin');
        return view('users.show', compact('user'));
    }

    public function index()
    {
        Gate::authorize('admin');
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        //$this->authorize('update', $user);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'section_number' => ['required', 'numeric'],
            'semester' => ['required'],
        ]);
        $data = $request->all();
        $user->update([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'section_number' => $data['section_number'],
            'semester' => $data['semester'],
        ]);
        return redirect()->route('root')->with('success', 'Profile saved successfully!');
    }
}
