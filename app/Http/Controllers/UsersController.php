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
        $users = User::paginate(20); // paginate
        return view('users.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        if (!Auth::user()->is_admin) { // admins can edit any user
            $this->authorize('update', $user);
        }
        $self_editing = $request->self_editing;
        return view('users.edit', compact('user', 'self_editing'));
    }

    public function update(Request $request, User $user)
    {
        if (!Auth::user()->is_admin) { // admins can edit any user
            $this->authorize('update', $user);
        }
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
        $self_editing = $request->self_editing;
        if ($self_editing) {
            return redirect()->route('frontpage')->with('success', 'Profile saved successfully!');
        } else {
            return redirect()->route('users.index')->with('success', 'Profile saved successfully!');
        }
    }

    public function setAdmin(Request $request, User $user) {
        //$this->authorize('setAdmin'); // check if the current user can do this
        $user->update(['is_admin' => $request->is_admin]);
        return redirect()->route('users.index')->with('success', 'Permission set successfully.');
    }

}
