<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;

class ManagementController extends Controller{
    public function index(){
        return view('management.dashboard');
    }

    public function show(User $user){
        return view('management.profile', [
            'user' => $user,
        ]);
    }
}
