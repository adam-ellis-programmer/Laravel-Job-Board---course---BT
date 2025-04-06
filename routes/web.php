<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController; // nameSpace
use App\Http\Controllers\HomeController;

// route links controller file to method such as index, show, emial, etc
// resource is [posts,users,accounts,customers,agents,]
// we can then call CURD operations on these methods

// compact('jobs') from the controller to the view

// linking routes to controller methods
// This is a powerful shortcut that creates multiple routes for CRUD operations

// home route is seperate
Route::get('/', [HomeController::class, 'index']);


// Programmatically creates all our routes for jobs routes
// if we need to add other routes we add manually  -->Route::get('/jobs/admin',[JobController::class, 'admin']);

Route::resource('jobs', JobController::class);

// Route::get('/jobs',[JobController::class, 'index']);
// Route::get('/jobs/create', [JobController::class,'create']);

// // id routes need to be last -- routes need to be in order
// Route::get('/jobs/{id}', [JobController::class, 'show']);
// Route::post('/jobs', [JobController::class, 'store']);


// Route::get('/jobs', function () {
//         return view('jobs');
// })->name('jobs');





