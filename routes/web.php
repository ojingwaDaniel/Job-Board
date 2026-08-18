<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Models\Job;
use Database\Factories\JobFactory;
use Illuminate\Support\Facades\Route;
// Route::get("/",[JobController::class,"index"]);
Route::get("/",fn()=> to_route("jobs.index"));
Route::resource("jobs",JobController::class);
Route::resource("auth",AuthController::class)->only(["create","store"]);
Route::delete("auth",[AuthController::class,"destroy"])->name("logout");
Route::get("login", fn()=> to_route("auth.create"))->name("login");
Route::middleware("auth")->group(function(){
    Route::resource("jobs.application",JobApplicationController::class)->only(["create","store"]);
});