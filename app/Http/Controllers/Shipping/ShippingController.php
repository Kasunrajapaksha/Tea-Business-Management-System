<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShippingController extends Controller
{
    public function index(){
        return view('shipping.dashboard');
    }

    public function show(User $user){
        return view('shipping.profile', [
            'user' => $user,
        ]);
    }
}
