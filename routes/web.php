<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->to('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/job', [PostController::class, 'createJob']);
    Route::get('/news', [PostController::class, 'createNews']);
    Route::post('/', [PostController::class, 'store']);
});
