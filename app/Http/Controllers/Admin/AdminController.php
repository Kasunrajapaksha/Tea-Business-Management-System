<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MaterialPurchase;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\TeaPurchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index(){

        $customers = Customer::all();
        $orders = Order::all();
        $users = User::all();
        $suppliers = Supplier::all();
        $total_supplier_payaments = SupplierPayment::sum('amount');
        $total_tea_purchases = TeaPurchase::sum(DB::raw('quantity * price_per_Kg'));
        $total_material_purchases = MaterialPurchase::sum(DB::raw('units * unit_price'));


        $currentWeekStart = Carbon::now()->startOfMonth();
        $currentWeekEnd = Carbon::now()->endOfMonth();

        $customersAddedThisMonth = Customer::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();
        $ordersAddedThisMonth = Order::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();


        return view('admin.dashboard', compact([
            'customers',
            'orders',
            'users',
            'suppliers',
            'total_supplier_payaments',
            'total_tea_purchases',
            'total_material_purchases',
            'customersAddedThisMonth',
            'ordersAddedThisMonth'
        ]));
    }

    public function customerReport(Request $request){
        $customers = Customer::all();
        $userIds = $customers->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        $request->validate([
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $customers = Customer::query();

        if($request->has('start_date') && $request->has('end_date')){
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

            $customers = $customers->whereBetween('created_at', [$startDate, $endDate]);
        }

        $customers = $customers->get();

        return view('reports.customer', compact('customers', 'users'));
    }

    public function orderReport(){
        $orders = Order::all();
        return view('reports.order',compact('orders'));
    }

    public function supplierPayament(){
        $payments = SupplierPayment::all();
        return view('reports.supplier-payament',compact('payments'));
    }

    public function teaPurchase(){
        $purchases = TeaPurchase::all();

        return view('reports.tea-purchase',compact('purchases'));
    }

}
