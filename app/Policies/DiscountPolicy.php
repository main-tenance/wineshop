<?php

namespace App\Policies;

use App\Models\Discount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountPolicy
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
        return $user->isManager();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Discount $discount)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Discount $discount)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Discount $discount)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Discount $discount)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Discount $discount)
    {
        //
    }
}
