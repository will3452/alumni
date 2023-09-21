<?php

use App\Http\Controllers\DonationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
/**LANDING PAGE */

Route::get('/', function () {
    return redirect()->intended('dashboard');
});

/**PROTECTED ROUTES */

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('home');

    // DONATIONS
    Route::prefix('/donations')->name('donations.')->group(function () {
        Route::post('/', [DonationController::class, 'store']);
        Route::get('/', [DonationController::class, 'index']);
        Route::get('/create', [DonationController::class, 'create']);
        Route::get('/{donation}', [DonationController::class, 'show']);
    });

});

/**
 * REGISTRATION AND AUTHENTICATION
 */

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Register');
});

Route::get('/logout', function () {
    Auth::logout();
    return back();
});

Route::post('/login', function (Request $request) {
    $creds = $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => 'required',
    ]);
    if (Auth::attempt($creds)) {
        return redirect()->intended();
    }

    return back()->withErrors(['Email' => 'Credential is not match to our record.']);
});

Route::post('/register', function (Request $request) {

    $details = $request->validate([
        'name' => 'required',
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:6'],
        'type' => 'required',
    ]);

    $details['password'] = bcrypt($details['password']);
    $user = User::create(
        $details,
    );

    return back();
});
