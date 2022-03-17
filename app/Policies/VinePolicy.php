<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vine;
use Illuminate\Auth\Access\HandlesAuthorization;

class VinePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vine $vine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vine $vine)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vine $vine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vine $vine)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vine $vine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vine $vine)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vine $vine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vine $vine)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vine $vine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vine $vine)
    {
        return false;
    }
}
