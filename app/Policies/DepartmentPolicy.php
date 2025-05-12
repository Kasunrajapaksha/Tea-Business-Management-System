<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;

class DepartmentPolicy{
    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'create-department');
    }

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'view-department');
    }

    public function update(User $user, Department $department): bool{
        if($user->role->permissions->contains('permission_name', 'update-department')){
            return true;
        }
        return false;
    }
}
