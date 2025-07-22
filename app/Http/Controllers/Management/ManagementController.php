<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Models\Material;
use App\Models\MaterialPurchase;
use App\Models\Order;
use App\Models\PaymentRequest;
use App\Models\ShippingProvider;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\Tea;
use App\Models\TeaPurchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller{
    public function index(){
        $customers = Customer::all();
        $users = User::all();
        $suppliers = Supplier::all();
        $providers = ShippingProvider::all();
        $orders = Order::all();
        $teaStocks = Tea::all();
        $materialStocks = Material::all();
        $payment_requests = PaymentRequest::all();

        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        //cost
        $totalCost = SupplierPayment::sum('amount');
        $costThisMonth = SupplierPayment::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('amount');
        $costLastMonth = SupplierPayment::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('amount');
        if ($costLastMonth > 0) {
            $costPercentage = (($costThisMonth - $costLastMonth) / $costLastMonth) * 100;
        } else {
            $costPercentage = $costThisMonth > 0 ? 100 : 0;
        }

        $totalRevenue = CustomerPayment::sum('total_amount');
        $revenueThisMonth = CustomerPayment::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('total_amount');
        $revenueLastMonth = CustomerPayment::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total_amount');
        if ($revenueLastMonth > 0) {
            $revenuePercentage = (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100;
        } else {
            $revenuePercentage = $revenueThisMonth > 0 ? 100 : 0;
        }

        //orders
        $totalOrders = Order::all()->count();
        $ordersThisMonth = Order::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $ordersLastMonth = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        if ($ordersLastMonth > 0) {
            $orderPercentage = (($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100;
        } else {
            $orderPercentage = $ordersThisMonth > 0 ? 100 : 0;
        }








        return view('management.dashboard', compact([
            'customers',
            'users',
            'suppliers',
            'providers',
            'orders',
            'teaStocks',
            'materialStocks',
            'payment_requests',
            'totalCost',
            'costThisMonth',
            'costLastMonth',
            'costPercentage',
            'totalRevenue',
            'revenueThisMonth',
            'revenueLastMonth',
            'revenuePercentage',
            'totalOrders',
            'ordersThisMonth',
            'ordersLastMonth',
            'orderPercentage'
        ]));
    }


}
