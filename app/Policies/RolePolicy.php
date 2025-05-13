<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy{

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'view-role');
    }

    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'create-role');
    }

    public function update(User $user): bool{
        if($user->role->permissions->contains('permission_name', 'update-role')){
            return true;
        }
        return false;
    }

}
