<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewMyJob", Job::class);
        $myJobs = auth()->user()->employer->jobs()->with("employer", "jobApplications.user",)->withTrashed()->get();
        return view("my_jobs.index", compact("myJobs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("createAJob", Job::class);
        return view("my_jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        //
        $this->authorize("createAJob", Job::class);

        auth()->user()->employer->jobs()->create($request->validated());
        return redirect()->route("my-jobs.index")->with('success', 'You sucessfully created a Job');
    }



    public function edit(Job $myJob)
    {
        $this->authorize("update", $myJob);

        return view("my_jobs.edit", compact("myJob"));
    }


    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize("update", $myJob);
        $myJob->update($request->validated());
        return redirect()->route("my-jobs.index")->with("success", "Job updated sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();
        return redirect()->route("my-jobs.index")->with("success","Job deleted successfully");
    }
    public function restore(Job $myJob){
        $myJob->restore();
        return redirect()->route("my-jobs.index")->with("success","Job restored successfully");
        
    }
}
