<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-supplier');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'create-supplier');

    }


    public function update(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-supplier');

    }


    public function delete(User $user, Supplier $supplier): bool
    {
        return false;
    }


}
