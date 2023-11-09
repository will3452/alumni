<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::where('type', '!=', User::TYPE_ADMIN)->get();
        return view('users.index', compact('users'));
    }
}
