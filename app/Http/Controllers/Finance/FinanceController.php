<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\User;

class FinanceController extends Controller{
    public function index(){
        return view('finance.dashboard');
    }

    public function show(User $user){
        return view('finance.profile', [
            'user' => $user,
        ]);
    }
}
