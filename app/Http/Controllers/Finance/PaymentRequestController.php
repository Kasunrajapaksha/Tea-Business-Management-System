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

        $requests = (Auth::user()->department->department_name == 'Finance'
            ? PaymentRequest::where('status',  '=',0)->get()
            : PaymentRequest::all()
        );

        $myRequests = PaymentRequest::where('handler_id', Auth::user()->id)->get();
        $completedRequests = PaymentRequest::whereIn('status', [5,6])->get();

        return view('finance.request.index', compact(['requests','myRequests','completedRequests']));
    }

    public function show(PaymentRequest $request){

        Gate::authorize('view', PaymentRequest::class);

        if(Auth::user()->department->department_name == 'Finance'){
            $request->update([
                'status' => $request->status > 1 ? $request->status : 1,
                'handler_id' => Auth::user()->id,
            ]);


        }

        return view('finance.request.show', compact('request'));
    }

    public function update(PaymentRequest $request, $status){
        Gate::authorize('update', PaymentRequest::class);

        if(Auth::user()->department->department_name == 'Finance' && $request->status < 3){

            $request->update([
                'status' => (int)$status,
            ]);
        }

        return view('finance.request.show', compact('request'));
    }
}
