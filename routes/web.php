<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\myJobApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
// Route::get("/",[JobController::class,"index"]);
Route::get("/", fn() => to_route("jobs.index"));
Route::resource("jobs", JobController::class);
Route::get("register", [RegisterController::class, "create"])->name("register");
Route::post("register", [RegisterController::class, "store"])->name("register.store");
Route::get("login", [AuthController::class, "login"])->name("login");
Route::post("login", [AuthController::class, "store"])->name("auth.store");


Route::middleware("auth")->group(function () {

  
    Route::get("/email/verify", function () {
        return view("auth.verify-email");
    })->name("verification.notice");

    
    Route::get("/email/verify/{id}/{hash}", function (
        EmailVerificationRequest $request
    ) {
        $request->fulfill();

        return redirect()->route("jobs.index")
            ->with("success", "Your email has been verified!");
    })->middleware(["signed", "throttle:6,1"])
        ->name("verification.verify");

    
    Route::post("/email/verification-notification", function (
        Request $request
    ) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            "status",
            "verification-link-sent"
        );
    })->middleware("throttle:6,1")
        ->name("verification.send");
});

Route::middleware("auth")->group(function () {
    Route::resource("jobs.application", JobApplicationController::class)->only(["create", "store"]);
    Route::resource("my-job-applications", myJobApplicationController::class)->only("index", "destroy");
    Route::get("job-application/{application}/View-CV", [JobApplicationController::class, "viewCv"])->name("job-application.viewCv");
    Route::delete("logout", [AuthController::class, "destroy"])->name("logout");
    Route::resource('employer', EmployerController::class)->only("create", "store");
    Route::middleware('employer')->resource('my-jobs', MyJobController::class);
    Route::patch('my-jobs/{my_job}', [MyJobController::class, "restore"])->withTrashed()->name("my-jobs.restore");
});
