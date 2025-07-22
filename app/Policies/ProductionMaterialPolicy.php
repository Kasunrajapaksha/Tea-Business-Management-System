<?php

namespace App\Policies;

use App\Models\ProductionMaterial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductionMaterialPolicy
{
    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-production_material');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-production_material');
    }


    public function update(User $user, ProductionMaterial $productionMaterial): bool
    {
        if($productionMaterial->inventory_transaction->first()->status == 0 && $user->role->permissions->contains('permission_name', 'update-production_material')){
            return true;
        }
        return false;

    }


    public function delete(User $user, ProductionMaterial $productionMaterial): bool
    {
        if($productionMaterial->inventory_transaction->first()->status == 0 && $user->role->permissions->contains('permission_name', 'delete-production_material')){
            return true;
        }
        return false;
    }

}
