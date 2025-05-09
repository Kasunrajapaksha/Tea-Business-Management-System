<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index(){
        return view('marketing.dashboard');
    }

    public function show(User $user){
        return view('marketing.profile', [
            'user' => $user,
        ]);
    }
}
