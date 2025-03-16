<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Report;
use App\Models\User;

class ReportPolicy
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
    public function view(User $user, Report $report)
    {
        return $user->id === $report->userID; // Only allow the owner to view
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


    /**
     * Determine whether the user can delete the model.
     */


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Report $report): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Report $report): bool
    {
        return false;
    }

    public function update(User $user, Report $report)
    {
        return $user->id === $report->userID;
    }

    public function delete(User $user, Report $report)
    {
        return $user->id === $report->userID;
    }
}
