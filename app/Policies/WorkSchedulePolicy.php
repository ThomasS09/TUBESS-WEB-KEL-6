<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkSchedule;
use Illuminate\Auth\Access\Response;

class WorkSchedulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WorkSchedule $workSchedule): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WorkSchedule $workSchedule): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorkSchedule $workSchedule): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WorkSchedule $workSchedule): bool
    {
        return $user->id === $workSchedule->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WorkSchedule $workSchedule): bool
    {
        return $user->id === $workSchedule->user_id;
    }
}
