<?php

namespace App\Policies;

use App\Models\TeaPurchase;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeaPurchasePolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-tea-purchase');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'purchase-tea');
    }

    public function update(User $user, TeaPurchase $teaPurchase): bool
    {
        return false;
    }


    public function delete(User $user, TeaPurchase $teaPurchase): bool
    {
        return false;
    }

}
