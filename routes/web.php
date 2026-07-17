<?php

use App\Http\Controllers\JobController;
use App\Models\Job;
use Database\Factories\JobFactory;
use Illuminate\Support\Facades\Route;
Route::get("/",[JobController::class,"index"]);
Route::resource("jobs",JobController::class)->except("index");