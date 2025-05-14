<?php

namespace App\Policies;

use App\Models\SupplierPayment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPaymentPolicy
{

    
    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-supplier-payment');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-supplier-payment');
    }


    public function update(User $user, SupplierPayment $supplierPayment): bool
    {
        return false;
    }


    public function delete(User $user, SupplierPayment $supplierPayment): bool
    {
        return false;
    }

}
