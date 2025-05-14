<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PaymentRequestController extends Controller
{
    public function index(){
        Gate::authorize('view', PaymentRequest::class);

        $requests = (Auth::user()->department->department_name == 'Finance'
            ? PaymentRequest::where('status', 0)->get()
            : PaymentRequest::all()
        );

        $myRequests = PaymentRequest::where('handler_id', Auth::user()->id)->get();

        return view('finance.request.index', compact(['requests','myRequests']));
    }

    public function show(PaymentRequest $request){
        Gate::authorize('view', PaymentRequest::class);
        
        if(Auth::user()->department->department_name == 'Finance'){
            $request->update([
                'status' => 1, //under review
                'handler_id' => Auth::user()->id,
            ]);


        }

        return view('finance.request.show', compact('request'));
    }
}
