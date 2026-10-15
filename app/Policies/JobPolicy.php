<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }
    public function viewMyJob(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Job $job): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */

    public function createAJob(User $user): bool
    {

        return $user->employer !== null;
    }
    public function createAJobApplication(User $user, Job $job)
    {

        if ($job->employer->user_id === $user->id) {
            return Response::deny("You cant create Application for the job you posted");
        }
        return Response::allow();
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job)
    {
        if ($job->employer->user_id !== $user->id) {
            return  Response::deny("You cant edit a job you did'nt post");
        }
        if ($job->jobApplications()->exists() > 0) {
            return  Response::deny("You can't edit a job that has applications");
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return $job->employer->user_id === $user->id;
    }

    public function apply(User $user, Job $job): bool
    {
        return  !$job->userHasApply($user);
    }

    public function posted(User $user, Job $job): bool
    {
        return $job->isPosted($user);
    }
}
