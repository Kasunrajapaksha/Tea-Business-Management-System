<?php

namespace App\Http\Controllers\Tea;

use App\Http\Controllers\Controller;
use App\Models\User;

class TeaController extends Controller{
    public function index(){
        return view('tea.dashboard');
    }

    
}
