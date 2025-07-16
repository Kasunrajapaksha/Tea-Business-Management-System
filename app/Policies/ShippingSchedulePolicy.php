<?php

namespace App\Policies;

use App\Models\ShippingSchedule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShippingSchedulePolicy{

    public function view(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'view-shipping-schedule');
    }


    public function create(User $user): bool{
        return $user->role->permissions->contains('permission_name', 'create-shipping-schedule');
    }


    public function update(User $user, ShippingSchedule $schedule): bool{

        if(($schedule->order->status == 13 || $schedule->order->status >= 17) && $user->role->permissions->contains('permission_name', 'update-shipping-schedule')){
            return true;
        }
        return false;
    }


    public function delete(User $user, ShippingSchedule $shippingSchedule): bool{
        return false;
    }

}
