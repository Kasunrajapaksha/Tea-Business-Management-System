<?php

namespace App\Policies;

use App\Models\MaterialPurchase;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MaterialPurchasePolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-material-purchase');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'purchase-material');
    }

    public function update(User $user, MaterialPurchase $materialPurchase): bool
    {
        return false;
    }

    public function delete(User $user, MaterialPurchase $materialPurchase): bool
    {
        return false;
    }

}
