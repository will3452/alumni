<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\DonationController;
use App\Models\Career;
use App\Models\Donation;
use App\Models\Done;
use App\Models\User;
use Carbon\Carbon;
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
        $total_donations = Donation::whereStatus(Donation::STATUS_APPROVED)->sum('amount');
        try {
            $rate_last_week = (Donation::whereStatus(Donation::STATUS_APPROVED)->whereBetween('updated_at', [Carbon::now()->copy()->subWeek(), Carbon::now()])->sum('amount') / Donation::whereStatus(Donation::STATUS_APPROVED)->sum('amount')) * 100;
        } catch (Exception $error) {

            $rate_last_week = 0;
        }

        return Inertia::render('Dashboard', [
            'statistic' => [
                'total_donations' => $total_donations,
                'rate_last_week' => $rate_last_week,
                'total_users' => User::count(),
                'total_user_last_week' => (User::whereBetween('created_at', [Carbon::now()->copy()->subWeek(), Carbon::now()])->count() / User::count()) * 100,
                'total_careers' => Career::count(),
                'total_careers_last_week' => (Career::whereBetween('created_at', [Carbon::now()->copy()->subWeek(), Carbon::now()])->count() / Career::count()) * 100,
            ],
            'objectives' => auth()->user()->objectives()->with('career.items')->get(),
        ]);
    })->name('home');

    // OBJECTIVES
    Route::post('/add-objectives', function (Request $request) {
        return auth()->user()->objectives()->create($request->all());

        return redirect()->to('/dashboard');
    });

    Route::post('/mark-as-done', function (Request $request) {
        Done::updateOrCreate([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
        ]);

        return redirect()->to('/dashboard');
    });

    // DONATIONS
    Route::prefix('/donations')->name('donations.')->group(function () {
        Route::post('/', [DonationController::class, 'store']);
        Route::get('/', [DonationController::class, 'index']);
        Route::get('/create', [DonationController::class, 'create']);
        Route::get('/{donation}', [DonationController::class, 'show']);
    });

    //CAREERS
    Route::prefix('/careers')->name('careers.')->group(function () {
        Route::post('/item', [CareerController::class, 'storeItem']);
        Route::post('/item/{careerItem}', [CareerController::class, 'deleteItem']);
        Route::post('/', [CareerController::class, 'store']);
        Route::get('/', [CareerController::class, 'index']);
        Route::get('/create', [CareerController::class, 'create']);
        Route::get('/{career}', [CareerController::class, 'show']);
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
