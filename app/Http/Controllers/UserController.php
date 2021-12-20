<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.form.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'level'     => 'required',
            'status'    => 'required'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt('secret'),
            'level'     => $request->level,
            'status'    => $request->status
        ]);

        return redirect()->route('user.index')->with('userPageMessage', 'User Created Successfully.');
    }

    public function edit(User $user)
    {
        return view('user.form.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'level'     => 'required',
            'status'    => 'required'
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('userPageMessage', 'User Updated Successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('userPageMessage', 'user Deleted Successfully');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }
}
