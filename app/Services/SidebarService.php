<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SidebarService{
    public static function getSidebarRoutes(){
        $userDepartment = Auth::user()->department->department_name;

        $sidebarRoutes = self::getRoleLinks($userDepartment);
        return $sidebarRoutes;

    }

    private static function getRoleLinks($department){
        switch ($department) {
            case 'Admin':
                return [
                    'dashboard' => 'admin.index',
                ];

            case 'Marketing':
                return [
                    'dashboard' => 'marketing.index',
                ];

            case 'Finance':
                return [
                    'dashboard' => 'finance.index',
                ];

            case 'Production':
                return [
                    'dashboard' => 'production.index',
                ];

            case 'Tea':
                return [
                    'dashboard' => 'tea.index',
                ];

            case 'Shipping':
                return [
                    'dashboard' => 'shipping.index',
                ];

            case 'Management':
                return [
                    'dashboard' => 'management.index',
                ];
            case 'Warehouse':
                return [
                    'dashboard' => 'warehouse.index',
                ];
        }
    }
}
