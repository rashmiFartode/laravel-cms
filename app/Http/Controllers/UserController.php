<?php

namespace App\Http\Controllers;

Use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();
        Session()->flash('status', 'Success');
        return redirect()->route('users.index');
    }
}
