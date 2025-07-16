<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\greaterThan;

class PaymentRequestController extends Controller
{

    public function index(){
        Gate::authorize('view', PaymentRequest::class);

        $requests = PaymentRequest::latest()->paginate(8);

        return view('finance.request.index', compact(['requests']));
    }

    public function show(PaymentRequest $request){

        Gate::authorize('view', PaymentRequest::class);

        if(Auth::user()->department->department_name == 'Finance'){
            $request->update([
                'status' => $request->status == 0 ? 1 : $request->status,
                'handler_id' => Auth::user()->id,
            ]);


        }

        return view('finance.request.show', compact('request'));
    }

    public function cancel(PaymentRequest $request){
        Gate::authorize('update', $request);

        $request->update([
            'status' => 2, //cancel
        ]);

        return view('finance.request.show', compact('request'));
    }
}
