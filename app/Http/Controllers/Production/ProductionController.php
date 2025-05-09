<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProductionController extends Controller
{
    public function index(){
        return view('production.dashboard');
    }

    public function show(User $user){
        return view('production.profile', [
            'user' => $user,
        ]);
    }
}
