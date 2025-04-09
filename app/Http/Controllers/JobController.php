<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $jobs = [
        //     'Software Engineer',
        //     'Web Developer',
        //     'Data Scientist',
        // ];
        
         $jobs = Job::all();

        // return view('jobs/index', compact( 'jobs'));
        return view('jobs/index')->with('jobs', $jobs) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
            return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Create a new job listing with the validated data
        Job::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    // Model binding, allows us to type hint 
    // a model in a conteoller method
    // laravel fetches the model from the database based on this param
    // Returns a view
    // takes in the job with model binding 
    // we return the view and pass that job in
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): string
    {
        //
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        //
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        //
        return 'update';
    }

    
}
