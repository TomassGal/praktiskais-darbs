<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
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
    public function update(User $user, User $model): bool
    {
        return $user->id == $model->id;
    }


    public function block(User $user, User $model): bool
    {
        return ($user->isAdmin() && !$model->isBlocked());
    }
    public function unBlock(User $user, User $model): bool
    {
        return ($user->isAdmin() && $model->isBlocked());
    }
    public function addAdmin(User $user, User $model): bool
    {
        return ($user->isAdmin());
    }
    public function beAdmin(User $user, User $model){
        return !($model->auctions()->count() || $model->bids()->count() || $model->isAdmin());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isAdmin();
    }
}
