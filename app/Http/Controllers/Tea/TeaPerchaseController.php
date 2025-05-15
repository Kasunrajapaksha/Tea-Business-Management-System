<?php

namespace App\Http\Controllers\Tea;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\Tea;
use App\Models\TeaPurchase;
use App\Models\User;
use App\Notifications\TeaPaymentRequestNotification;
use Illuminate\Support\Facades\Gate;

class TeaPerchaseController extends Controller
{
    public function index(){
        Gate::authorize('view', TeaPurchase::class);

        $purchases = TeaPurchase::all();

        return view('tea.purchase.index', compact('purchases'));
    }

    public function create(){
        Gate::authorize('create', TeaPurchase::class);
        Gate::authorize('create', PaymentRequest::class);

        $teas = Tea::all();
        $suppliers = Supplier::where('type',01)->get();

        return view('tea.purchase.create', compact(['teas','suppliers']));
    }

    public function store(){
        //authorization
        Gate::authorize('create', TeaPurchase::class);
        Gate::authorize('create', PaymentRequest::class);

        //validation
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'tea_id' => ['exists:teas,id'],
            'supplier_id' => ['exists:suppliers,id'],
            'quantity' => ['required','numeric',],
            'price_per_kg' => ['required','numeric',],
        ]);

        //create tea purchase
        $purchase = TeaPurchase::create($validateData);

        //update tea purchase no
        $purchase->update([
            "tea_purchase_no"=> 'TP'.
            str_pad($purchase->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($purchase->tea->id,2,'0', STR_PAD_LEFT) .
            str_pad($purchase->id,4,'0', STR_PAD_LEFT),
        ]);

        //create payment request
        $request = PaymentRequest::create([
            'amount' => $purchase->quantity * $purchase->price_per_kg,
            'supplier_id' => $purchase->supplier_id,
            'requester_id' => $purchase->user_id,
        ]);

        //set tea perchase foreign kay with payment request
        $purchase->update([
            'payment_request_id' => $request->id,
        ]);

        //update payament request no
        $request->update([
            "request_no"=> 'REQ'.
            str_pad($request->requester_id,2,'0', STR_PAD_LEFT)  .
            str_pad($request->supplier->id,2,'0', STR_PAD_LEFT) .
            str_pad($request->id,4,'0', STR_PAD_LEFT),
        ]);

        //notify users
        $notifyPaymentRequest = PaymentRequest::findOrFail($request->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Finance']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new TeaPaymentRequestNotification($notifyPaymentRequest));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        //return view
        return redirect()->route('tea.purchase.index')->with('success','Sent tea purchase request successfully!');
    }

}
