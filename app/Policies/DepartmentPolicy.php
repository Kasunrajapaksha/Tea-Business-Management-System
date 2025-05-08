<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy{
    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'create-department');
    }

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'read-department');
    }

    public function update(User $user, Department $department): bool{
        if($department->id > 9 && $user->role->permissions->contains('permission_name', 'update-department')){
            return true;
        }
        return false;
    }
}
