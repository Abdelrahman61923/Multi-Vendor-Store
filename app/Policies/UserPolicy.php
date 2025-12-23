<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function before($user, $ability)
    {
        if ($user->super_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('users.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, User $model): bool
    {
        return $user->hasAbility('users.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('users.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, User $model): bool
    {
        return $user->hasAbility('users.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, User $model): bool
    {
        return $user->hasAbility('users.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, User $model): bool
    {
        return $user->hasAbility('users.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, User $model): bool
    {
        return $user->hasAbility('users.force-delete');
    }
}
