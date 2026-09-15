<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class myJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $applications = auth()->user()->jobApplications()->with("job.employer")->latest()->get();
        return view("myJobApplications.index",compact("applications"));
    }

    
    public function destroy(string $id)
    {
        //
    }
}
