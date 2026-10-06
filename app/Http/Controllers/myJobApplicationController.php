<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class myJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $applications = auth()->user()->jobApplications()->with([
            'job' => function ($query) {
                $query->withCount("jobApplications")->withAvg("jobApplications","expected_salary");
            },
            'job.employer'
        ])->latest()->get();

        return view("myJobApplications.index", compact("applications"));
    }


    public function destroy(JobApplication $jobApplication)
    {
        //
        $jobApplication->delete();
        return redirect()->route('my-job-applications.index')->with("delete", "Successfully deleted your application");

    }
}
