<?php

namespace App\Policies;

use App\Models\User;
use App\Models\job;
use Illuminate\Auth\Access\Response;


// viewAny(User $user): Determines if the user can view a list of jobs. This would control access to index pages or listings.
// view(User $user, job $job): Determines if the user can view a specific job. This controls access to show/detail pages.
// create(User $user): Determines if the user can create new jobs. This controls access to job creation forms and actions.
// update(User $user, job $job): Determines if the user can edit a specific job. This controls access to edit forms and update actions.
// delete(User $user, job $job): Determines if the user can delete a specific job.
// restore(User $user, job $job): Determines if the user can restore a soft-deleted job (if soft deletes are enabled).
// forceDelete(User $user, job $job): Determines if the user can permanently delete a job that was soft-deleted.

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, job $job): bool
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, job $job): bool
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, job $job): bool
    {
        return false;
    }
}
