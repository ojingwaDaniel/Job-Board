<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $this->authorize("viewAny",Job::class);
        $filters = request()->only(
            "search" ,
            "experience",
            "category",
            "min_salary",
            "max_salary"
        );
        $jobs = Job::with('employer')->latest()->filter($filters)->get();
        
    
        return view('jobs.index',['jobs'=> $jobs]);
    }

   
    public function show(Job $job)
    {
        $this->authorize("view",$job);
        $job = $job->load("employer.jobs");
        return view("jobs.show",compact("job"));
    }

   
    
}
