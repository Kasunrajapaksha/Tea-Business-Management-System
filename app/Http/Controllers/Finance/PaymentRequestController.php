<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentRequestController extends Controller
{
    public function index(){
        Gate::authorize('view', PaymentRequest::class);
        $requests = PaymentRequest::all();
        return view('finance.request.index', compact('requests'));
    }
}
