<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController; // nameSpace
use App\Http\Controllers\HomeController;


use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;

use App\Http\Middleware\LogRequest;
// Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(LogRequest::class);

// seperate route to jobs
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('jobs', JobController::class); // /jobs
Route::get('/jobs/{id}/save', [JobController::class, 'save'])->name('jobs.save'); // /jobs/:id

// auth routes >--------------------------------------------------------------------------
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// add admin routes --
