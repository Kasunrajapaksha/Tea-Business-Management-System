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
                    'profile' => 'admin.show',
                    'dashboard' => 'admin.index',
               
                ];

            case 'Marketing':
                return [
                    'profile' => 'marketing.show',
                    'dashboard' => 'marketing.index',
                   
                ];

            case 'Finance':
                return [
                    'profile' => 'finance.show',
                    'dashboard' => 'finance.index',
                 
                ];

            case 'Production':
                return [
                    'profile' => 'production.show',
                    'dashboard' => 'production.index',
                    
                ];

            case 'Tea':
                return [
                    'profile' => 'tea.show',
                    'dashboard' => 'tea.index',
             
                ];

            case 'Shipping':
                return [
                    'profile' => 'shipping.show',
                    'dashboard' => 'shipping.index',
                  
                ];

            case 'Management':
                return [
                    'profile' => 'management.show',
                    'dashboard' => 'management.index',
                    
                ];
        }
    }
}
