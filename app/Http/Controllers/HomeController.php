<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->status == 'for_review') {
            alert()->error('Your account is not yet approved by administrator.'); 
            auth()->logout(); 
            return redirect()->to(route('login')); 
        }

        if (auth()->user()->status == 'rejected') {
            alert()->error('The Administrator does not allow you to access the application.'); 
            auth()->logout(); 
            return redirect()->to(route('login')); 
        }
        return view('home');
    }
}
