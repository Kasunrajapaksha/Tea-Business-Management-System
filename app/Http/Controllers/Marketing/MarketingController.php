<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MarketingController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('marketing.dashboard', compact('customers'));
    }


}
