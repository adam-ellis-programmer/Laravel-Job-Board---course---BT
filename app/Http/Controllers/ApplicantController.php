<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;

class ApplicantController extends Controller
{
    // @desc   Store a new job application
    // @route  POST /jobs/{job}/apply
    //  Job $job -> model binding == we get access to the whole job object
    // not just the id 
    public function store(Request $request, Job $job): RedirectResponse
    {

        // ->exists() just returns true / false with not record  
        // Checks for an existing application
        $existingApplication = Applicant::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this job.');
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_number' => 'string|max:20',
            'contact_email' => 'required|email',
            'message' => 'string',
            'location' => 'string|max:255',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // dd('hello');

        // Handle the resume file upload
        if ($request->hasFile('resume')) {
            // store and return a full path
            $path = $request->file('resume')->store('resumes', 'public');
            // add to database
            $validatedData['resume_path'] = $path;
        }


        // Store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted!');
    }


    // @desc   Delete a job application
    // @route  DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully.');
    }
}
