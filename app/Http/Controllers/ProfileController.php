<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $data = $request->all();
        auth()->user()->update($data);

        alert()->success('Success', 'profile was updated!');

        return back();
    }
}
