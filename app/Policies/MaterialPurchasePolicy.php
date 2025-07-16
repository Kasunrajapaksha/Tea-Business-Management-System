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
        if($materialPurchase->payment_request->status == 0 && $user->role->permissions->contains('permission_name', 'update-material-purchase')){
            return true;
        }
        return false;
    }

    public function delete(User $user, MaterialPurchase $materialPurchase): bool
    {
        if($materialPurchase->payment_request->status == 0 && $user->role->permissions->contains('permission_name', 'delete-material-purchase')){
            return true;
        }
        return false;
    }

}
