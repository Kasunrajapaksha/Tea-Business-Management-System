<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SidebarService{
    public static function getSidebarRoutes(){
        $userRole = Auth::user()->role->role_name;

        $sidebarRoutes = self::getRoleLinks($userRole);
        return $sidebarRoutes;

    }

    private static function getRoleLinks($role){
        switch ($role) {
            case 'Admin':
                return [
                    'profile' => 'admin.show',
                    'dashboard' => 'admin.index'
                ];

            case 'Marketing Manager':
                return [
                    'profile' => 'marketing.show',
                    'dashboard' => 'marketing.index'
                ];
        }
    }
}
