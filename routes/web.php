<?php

use App\Exports\CareerProgressExport;
use App\Exports\CourseExport;
use App\Exports\DonationsExport;
use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Models\CareerProgress;
use App\Models\DoneStep;
use App\Models\Step;
use App\Models\UserCourse;
use App\Models\UserStep;
use App\Notifications\UserStepsApproval;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true]);

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->to('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

// admin routes
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/donations', [DonationController::class, 'adminIndex'])->name('donation.index');
    Route::get('/donations/{user}', [DonationController::class, 'adminShow'])->name('donation.show');
});

// alumni

Route::prefix('/alumni')->name('alumni.')->group(function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

    // donations
    Route::get('/donations', [DonationController::class, 'index'])->name('donations');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
});

Route::prefix('/coordinator')->name('coor.')->group(function () {
    Route::get('/donations', [DonationController::class, 'coordinatorIndex'])->name('donations');
    Route::get('/approve/{donation}', [DonationController::class, 'coordinatorApprove'])->name('approve');
});

// general
Route::post('/save-profile', [ProfileController::class, 'saveProfile'])->name('profile.save');

// notifications

Route::view('/notifications', 'notifications');
Route::view('/news', 'posts.alumni');
Route::view('/browse-alumni', 'alumni');

Route::prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/job', [PostController::class, 'createJob']);
    Route::get('/news', [PostController::class, 'createNews']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{post}', [PostController::class, 'update']);
    Route::delete('/{post}', [PostController::class, 'destroy']);
    Route::get('/edit/{post}', [PostController::class, 'edit']);
    Route::get('/delete-confirm/{post}', [PostController::class, 'deleteConfirm']);
    Route::get('/{post}', [PostController::class, 'show']);
});

Route::prefix('/courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/', [CourseController::class, 'store']);
    Route::get('/step/{step}', [CourseController::class, 'showStep']);
    Route::get('/create', [CourseController::class, 'create']);
    Route::post('/step', [CourseController::class, 'storeStep']);
    Route::get('/delete-confirm/{course}', [CourseController::class, 'deleteConfirm']);
    Route::put('/{course}', [CourseController::class, 'update']);
    Route::delete('/{course}', [CourseController::class, 'destroy']);
    Route::get('/edit/{course}', [CourseController::class, 'edit']);
    Route::get('/{course}', [CourseController::class, 'show']);
    Route::get('/remove-step/{step}', [CourseController::class, 'removeStep']);
});

Route::middleware('auth')->group(function() {
    Route::get('/approve/{user}', function (User $user) {
        if (auth()->user()->type != User::TYPE_ADMIN) {
            alert()->error('Unauthorized', 'You are not allowed!');
            return back(); 
        }

        $user->update(['status' => 'active']); 

        alert()->success('Success', 'User has been successfully accepted!');

        return back(); 
    }); 
    
    Route::get('/reject/{user}', function (User $user) {
        if (auth()->user()->type != User::TYPE_ADMIN) {
            alert()->error('Unauthorized', 'You are not allowed!');
            return back(); 
        }

        $user->update(['status' => 'rejected']); 
        alert()->success('Success', 'User has been successfully rejected!');

        return back();
    }); 
}); 

Route::get('terms-n-conditions', function () {
    return view('terms-n-conditions'); 
}); 


Route::post('/set-goal', function (Request $request) {
    UserCourse::create(['user_id' => auth()->id(), 'course_id' => $request->course_id]); 
    alert()->success('Success'); 

    return back(); 
});

Route::get('/done/{step}', function (Step $step) {
    $isExists = DoneStep::whereUserId(auth()->id())->whereStepId($step->id)->exists(); 
    if ($isExists) {
        alert()->warning('You already mark this step as Done!'); 
        return back(); 
    }
    DoneStep::create(['user_id' => auth()->id(), 'step_id' => $step->id]);
    alert()->success('success', 'Great!');
    return back(); 
}); 


// exports 
Route::get('/exports', function (Request $request) {
    if ($request->type == 'USER') return Excel::download(new UsersExport, 'users.xlsx'); 
    if ($request->type == 'DONATION') return Excel::download(new DonationsExport, 'donations.xlsx'); 
    if ($request->type == 'COURSE') return Excel::download(new CourseExport, 'courses.xlsx'); 
    if($request->type == 'ALUMNI') return Excel::download(new CareerProgressExport(), 'alumnidata.xlsx'); 
});

Route::post('/submit-user-step/{userStep}', function (UserStep $userStep) {
    $userStep->update(['status' => 'APPROVED']);

    alert()->success('Success', 'Approved!'); 

    return back(); 
}); 

Route::post('/submit-user-step', function (Request $request) {
    $data = $request->validate([
        'user_id' => ['required'], 
        'step_id' => ['required'],
        'file' => ['required'],
    ]); 

    $data['file'] = $data['file']->store('public'); 
    UserStep::create($data); 
    alert()->success('Success', 'Your attachment has been uploaded.'); 

    $admins = User::whereType('Administrator')->get(); 

    foreach($admins as $admin) {
        $admin->notify(new UserStepsApproval($data['user_id'])); 
    }

    return back(); 
})->middleware(['auth']); 

Route::get('/set-goal', function () {
    return view('goals'); 
}); 

Route::get('/add-progress', function () {
    return view('progress'); 
}); 

Route::post('/add-progress', function (Request $request) {
    $data = $request->validate([
        'year' => 'required',
        'type' => 'required',
        'company' => '',
        'school' => '',
        'job' => '',
        'level' => '',
        'salary' => '', 
    ]);
    $data['user_id'] = auth()->id(); 
    CareerProgress::create($data);
    alert()->success('Success', 'Career progress added!'); 
    return back(); 
}); 