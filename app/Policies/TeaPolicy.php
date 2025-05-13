<?php

namespace App\Policies;

use App\Models\Tea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeaPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-tea');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'create-tea');
    }

    public function update(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-tea');
    }


    public function delete(User $user, Tea $tea): bool
    {
        return false;
    }

}
