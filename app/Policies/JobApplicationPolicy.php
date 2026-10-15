<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewCv(User $user ,JobApplication $application ){
       return  $application->job->employer->user_id == $user->id;
    }
}
