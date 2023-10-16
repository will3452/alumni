<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PostController;
use App\Models\Career;
use App\Models\Donation;
use App\Models\Done;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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
                'total_posts' => Post::count(),
                'total_posts_last_week' => (Post::whereBetween('created_at', [Carbon::now()->copy()->subWeek(), Carbon::now()])->count() / Post::count()) * 100,
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
        auth()->user()->objectives()->create($request->all());

        return redirect()->to('/dashboard');
    });

    Route::get('/profile', function (Request $request) {

        return inertia()->render('Profile', [
            'objectives' => auth()->user()->objectives()->with('career.items')->get(),
        ]);
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
        Route::put('/{donation}', [DonationController::class, 'update']);
    });

    // NOTIFICATIONS
    Route::prefix('/notifications')->name('notifications.')->group(function () {
        Route::get('/', function () {
            return inertia()->render('Notifications', ['notifications' => auth()->user()->notifications()->latest()->get()]);
        });
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

    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/', [PostController::class, 'index'])->name('index');
    });

    Route::get('/reports', function () {
        return Inertia::render('Reports');
    });

    Route::post('/reports', function (Request $request) {
        $model = $request->model;
        $report = ("\\App\\Models\\$model")::whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)])->get();

        return $report;
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

Route::get('/reset-password', function () {
    return Inertia::render('ResetPassword');
});

Route::post('/reset-password', function (Request $request) {
    $email = $request->email;
    $user = User::whereEmail($email)->first();
    if (!$user) {
        return back()->withErrors(['Email' => 'Credential is not match to our record.']);
    }

    $password = Str::random(8);

    $user->update(['password' => bcrypt($password)]);

    Mail::raw("Hello here is your temporarily password. $password", function ($message) use ($email) {
        $message->to($email)
            ->subject('temporarily password');
    });

    return 'please check your email!';
});

Route::post('update-password', function (Request $request) {
    auth()->user()->update(['password' => bcrypt($request->password)]);

    return 'Your password has been updated!';
});

Route::get('/terms-and-conditions', function () {
    return Inertia::render('TermsAndCondition');
});

Route::get('/logout', function () {
    Auth::logout();
    return back();
});

Route::post('/login', function (Request $request) {
    $creds = $request->validate([
        'email' => ['required', 'exists:users,email'],
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
        'course' => '',
        'school_year' => '',
    ]);

    $details['password'] = bcrypt($details['password']);
    $user = User::create(
        $details,
    );

    return back();
});
