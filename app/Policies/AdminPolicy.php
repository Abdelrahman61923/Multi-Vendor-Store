<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class AdminPolicy
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
        return $user->hasAbility('admins.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Admin $admin): bool
    {
        return $user->hasAbility('admins.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('admins.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Admin $admin): bool
    {
        return $user->hasAbility('admins.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Admin $admin): bool
    {
        return $user->hasAbility('admins.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Admin $admin): bool
    {
        return $user->hasAbility('admins.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Admin $admin): bool
    {
        return $user->hasAbility('admins.force-delete');
    }
}
