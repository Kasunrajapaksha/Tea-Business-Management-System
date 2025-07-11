<?php

namespace App\Policies;

use App\Models\ShippingProvider;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShippingProviderPolicy{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-shipping-provider');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'add-shipping-provider');
    }

    public function update(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-shipping-provider');
    }

    public function delete(User $user, ShippingProvider $shippingProvider): bool
    {
        return $user->role->permissions->contains('permission_name', 'delete-shipping-provider');
    }

}
