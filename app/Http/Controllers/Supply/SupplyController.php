<?php

namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SupplyController extends Controller{
    public function index(){
        return view('supply.dashboard');
    }

    public function show(User $user){
        return view('supply.profile', [
            'user' => $user,
        ]);
    }
}
