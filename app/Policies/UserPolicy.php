<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy{

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'view-user');
    }

    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'add-user');
    }

    public function update(User $user, User $model): bool{
        return $user->role->permissions->contains('permission_name', 'update-user');
    }
}
