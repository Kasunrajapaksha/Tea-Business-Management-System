<?php

namespace App\Policies;

use App\Models\PaymentRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentRequestPolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-payment-request');
    }


    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-payment-request');
    }


    public function update(User $user, PaymentRequest $paymentRequest): bool
    {
        if($paymentRequest->status == 1 && $user->role->permissions->contains('permission_name', 'update-payment-request')){
            return true;
        }
        return false;
    }


    public function delete(User $user, PaymentRequest $paymentRequest): bool
    {
        return $user->role->permissions->contains('permission_name', 'delete-payment-request');
    }


}
