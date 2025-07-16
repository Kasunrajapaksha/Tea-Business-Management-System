<?php

namespace App\Policies;

use App\Models\InventoryTransaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventoryTransactionPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-inventory');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'create-transaction');
    }

    public function update(User $user, InventoryTransaction $inventoryTransaction): bool
    {
        if($inventoryTransaction->transaction_type == 1){
            if($inventoryTransaction->status != 6 && $user->role->permissions->contains('permission_name', 'update-inventory')){
                return true;
            }
        } elseif($inventoryTransaction->transaction_type == 2){
            if($inventoryTransaction->status != 9 && $user->role->permissions->contains('permission_name', 'update-inventory')){
                return true;
            }
        }
        return false;
    }

    public function delete(User $user): bool
    {
        return false;
    }
}
