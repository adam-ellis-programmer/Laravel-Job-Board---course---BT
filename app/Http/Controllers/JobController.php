<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

// to handlel delete old file 
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Job;

class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $value = session()->get('test'); // This will return 'world'
        // dd($value);

        // $jobs = [
        //     'Software Engineer',
        //     'Web Developer',
        //     'Data Scientist',
        // ];

        // @desc  Show all job listings
        // @route GET /jobs 
        $jobs = Job::all();

        // return view('jobs/index', compact( 'jobs'));
        return view('jobs/index')->with('jobs', $jobs);
    }

    // @desc  create job
    // @route POST /jobs/create
    public function create(): View | RedirectResponse
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //  used to submit / save the data 
    // 
    // The main purposes of the store method are:

    // Receiving form data from POST requests
    // Validating the submitted data
    // Creating a new record in the database
    // Redirecting the user after successful creation

    public function store(Request $request): RedirectResponse
    {

        // die and dump 
        // dd($request->file('company_logo'));

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Create a new job listing with the validated data
        // Job::create([
        //     'title' => $validatedData['title'],
        //     'description' => $validatedData['description'],
        // ]);

        // Add the hardcoded user_id
        // $validatedData['user_id'] = auth()->user()->id; // is correct but gets warning
        $validatedData['user_id'] = Auth::user()->id;

        // Check if a file was uploaded
        if ($request->hasFile('company_logo')) {
            // Store the file and get the path 
            $path = $request->file('company_logo')->store('logos', 'public');
            // Add the path to the validated data array
            $validatedData['company_logo'] = $path;
        }

        // submit to database 
        Job::create($validatedData);

        // @desc Save job to database
        // @route POST /jobs

        // success variable --> stored in session on the next page load --- we use session helper
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
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

    // @desc  Show single job
    // @route GET /jobs/{id}
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        // Check if the user is authorized
        $this->authorize('update', $job);


        // ** Model Binding --> with $job
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request,  Job $job): RedirectResponse
    {

        // Check if the user is authorized
        $this->authorize('update', $job);


        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);


        // Check if a file was uploaded
        if ($request->hasFile('company_logo')) {
            // Delete the old company logo from storage
            if ($job->company_logo) {
                // . = concat
                Storage::delete('public/logos/' . basename($job->company_logo));
            }

            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add the path to the validated data array
            $validatedData['company_logo'] = $path;
        }

        // Update with the validated data
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Model Binding
    public function destroy(Job $job): RedirectResponse
    {

        // Check if the user is authorized
        $this->authorize('delete', $job);


        // If there is a company logo, delete it from storage
        if ($job->company_logo) {
            // . concat
            Storage::delete('public/logos/' . $job->company_logo);
        }

        // Delete the job
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
