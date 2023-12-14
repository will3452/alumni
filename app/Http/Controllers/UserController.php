<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $pending = User::where('type', '!=', User::TYPE_ADMIN)->whereStatus('for_review')->get();
        $active = User::where('type', '!=', User::TYPE_ADMIN)->whereStatus('active')->get(); 
        $rejected = User::where('type', '!=', User::TYPE_ADMIN)->whereStatus('rejected')->get(); 
        $users = $pending->merge($active);
        $users = $users->merge($rejected)->map(function($user, $key){
            return [
                'name' => $user->name, 
                'type' => $user->type, 
                'status' => $user->status, 
                'no' => $key + 1, 
                'id' => $user->id, 
            ];
        }); 

        return view('users.index', compact('users'));
    }
}
