<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\ProductionPlan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use function PHPUnit\Framework\isEmpty;

class ProductionPlanPolicy{


    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-production-plan');
    }


    public function create(User $user): bool
    {
        if($user->role->permissions->contains('permission_name', 'add-production-plan')){
            return true;
        }
        return false;
    }


    public function update(User $user, ProductionPlan $plan): bool
    {
        if($plan->order->status == 12 && $user->role->permissions->contains('permission_name', 'update-production-plan')){
            return true;
        }
        return false;
    }

    public function delete(User $user, ProductionPlan $productionPlan): bool
    {
        return false;
    }

}
