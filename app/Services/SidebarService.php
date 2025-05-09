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

            case 'Finance Manager':
                return [
                    'profile' => 'finance.show',
                    'dashboard' => 'finance.index'
                ];

            case 'Production Manager':
                return [
                    'profile' => 'production.show',
                    'dashboard' => 'production.index'
                ];

            case 'Tea Department Head':
                return [
                    'profile' => 'tea.show',
                    'dashboard' => 'tea.index'
                ];

            case 'Tea Teaser':
                return [
                    'profile' => 'tea.show',
                    'dashboard' => 'tea.index'
                ];

            case 'Shipping Manager':
                return [
                    'profile' => 'shipping.show',
                    'dashboard' => 'shipping.index'
                ];

            case 'General Manager':
                return [
                    'profile' => 'management.show',
                    'dashboard' => 'management.index'
                ];
        }
    }
}
