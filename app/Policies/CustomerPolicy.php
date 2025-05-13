<?php

namespace App\Policies;

use App\Models\User;

class CustomerPolicy{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-customer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-customer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-customer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return false;
    }


}
