<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-material');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-material');
    }


    public function update(User $user, Material $material): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-material');
    }


    public function delete(User $user, Material $material): bool
    {
        return $user->role->permissions->contains('permission_name', 'delete-material');
    }


}
