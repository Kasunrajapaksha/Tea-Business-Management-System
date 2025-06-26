<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-order');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'create-order');
    }

    public function update(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-order');
    }

    public function delete(User $user, Order $order): bool
    {
        return false;
    }

}
