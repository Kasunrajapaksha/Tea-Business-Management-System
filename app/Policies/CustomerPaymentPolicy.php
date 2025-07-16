<?php

namespace App\Policies;

use App\Models\CustomerPayment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPaymentPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-customer-payment');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-customer-payment');
    }


    public function update(User $user, CustomerPayment $customerPayment): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-customer-payment');
    }


    public function delete(User $user, CustomerPayment $customerPayment): bool
    {
        return false;
    }


}
