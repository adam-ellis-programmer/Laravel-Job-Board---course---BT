<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Illuminate\View\View;


class DashBoardController extends Controller
{
    public function index(Request $request): View
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get all job listings for the authenticated user
        // because we have a relationship to the applicants they will be on the jobs variable 
        $jobs = Job::where('user_id', $user->id)->with('applicants')->get();

        // dd($jobs); 

        return view('dashboard.index', compact('user', 'jobs'));
    }
}
