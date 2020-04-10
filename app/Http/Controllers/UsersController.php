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
        $related_infos=$user->answerRecords()->where('post_id','<','6')->orderby('post_id')->get();
        $basic_info=$related_infos[1]->answers;
        $language_info=$related_infos[2]->answers;
        $education_info=$related_infos[3]->answers;
        $belief_info=$related_infos[4]->answers;
        return view('users.show', compact('user','basic_info','language_info','education_info','belief_info'));
    }

    public function index()
    {
        Gate::authorize('admin');
        $users = User::Registered()->paginate(20); // paginate
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

    /**
     * set the admin
     */
    public function setAdmin(Request $request, User $user) {
        //$this->authorize('setAdmin'); // check if the current user can do this
        $user->update(['is_admin' => $request->is_admin]);
        return redirect()->route('users.index')->with('success', 'Permission set successfully.');
    }

    /**
     * destroy the user
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy',$user);
        $user->delete();
        return redirect()->route('users.index')->with('success','You have deleted this user');
    }
}
