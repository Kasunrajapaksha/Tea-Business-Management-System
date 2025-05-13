<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MarketingController extends Controller
{
    public function index(){
        return view('marketing.dashboard');
    }


}
