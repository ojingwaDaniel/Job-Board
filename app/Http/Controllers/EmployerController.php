<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class EmployerController extends Controller
{
   


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create",Employer::class);
        return view("employer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate(["company_name" => "required|min:3"]);
        auth()->user()->employer()->create($validatedData);
        return redirect()->route("my-jobs.index")->with("success","Your Employer account has been created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("update",Employer::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
