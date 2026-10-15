<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{

    public function create(Job $job)
    {
        $this->authorize('createAJobApplication', $job);
        Gate::authorize('apply', $job);

        return view("jobApplications.create", compact("job"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        $validatedData = $request->validate([
            'expected_salary' => "required|integer|min:1|max:1000000",
            "cv" => "required|file|mimes:pdf|max:2048"
        ]);
        $file = $request->file("cv");
        $cvPath = $file->store("cvs", "private");
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            "cv_path" => $cvPath

        ]);
        return redirect()->route("jobs.show", $job)->with("success", "Job Application submitted sucessfully");
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function viewCV(JobApplication $application)
    {
        $this->authorize("viewCv", $application);
        if (!$application->cv_path) {
            return back()->with('error', 'No CV was uploaded.');
        }

        $disk = Storage::disk('private');

        if (!$disk->exists($application->cv_path)) {
            return back()->with('error', 'CV file not found.');
        }

        $extension = strtolower(pathinfo($application->cv_path, PATHINFO_EXTENSION));

        if ($extension !== 'pdf') {
            return back()->with('error', 'Only PDF CVs can be viewed directly in the browser.');
        }

        $filePath = $disk->path($application->cv_path);
        $fileName = 'CV_' . $application->user->name . '.pdf';

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }
}
