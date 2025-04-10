<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // $title = 'Available Jobs';
        // $jobs = [
        //     'Software Engineer',
        //     'Web Developer',
        //     'Data Scientist',
        // ];
        // return view('pages.index', compact('title', 'jobs'));

        // session()->put('test', '123');
        // $value = session()->get('test');
        // dd($value);
        // session()->forget('test');


        // with gives us access to jobs in the view
        $jobs = Job::latest()->limit(6)->get();
        return view('pages.index')->with('jobs', $jobs);
    }
}
