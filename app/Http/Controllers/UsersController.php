<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show()
    {
        return view('users.show');
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
