<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController; // nameSpace
use App\Http\Controllers\HomeController;


use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashBoardController;
use App\Http\Middleware\LogRequest;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\BookmarkController;

use App\Http\Controllers\ApplicantController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(LogRequest::class);

// seperate route to jobs
// Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::get('/', [HomeController::class, 'index'])->name('home');

// *** only creates these routes *** // 
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'destroy']);

// *** take away auth and create all resource exept these routes *** //
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'destroy']);



// Route::resource('jobs', JobController::class); // /jobs

Route::get('/jobs/{id}/save', [JobController::class, 'save'])->name('jobs.save'); // /jobs/:id

// auth routes >--------------------------------------------------------------------------
// Route::get('/register', [RegisterController::class, 'register'])->name('register')->middleware('guest')->middleware('guest');; 
Route::middleware('guest')->group(function () {
  Route::get('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
  Route::get('/login', [LoginController::class, 'login'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


Route::middleware('auth')->group(function () {
  // index, store, destroy methods
  Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
  Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
  Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

// store method / named applicant.store
Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store');


Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicants.destroy')->middleware('auth');


// add admin routes --
