<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy{

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'view-permission');
    }

    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'create-permission');
    }


    public function update(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'update-permission');
    }


    public function delete(User $user): bool{
        return false;
    }


}
