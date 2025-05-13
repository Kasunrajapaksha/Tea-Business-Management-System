<?php

namespace App\Http\Controllers\Tea;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\Tea;
use App\Models\TeaPurchase;
use App\Models\User;
use App\Notifications\TeaPaymentRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $teas = Tea::all();
        $suppliers = Supplier::all();
        return view('tea.purchase.create', compact(['teas','suppliers']));
    }

    public function store(){
        Gate::authorize('create', TeaPurchase::class);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'tea_id' => ['exists:teas,id'],
            'supplier_id' => ['exists:suppliers,id'],
            'quantity' => ['required','numeric',],
        ]);

        $purchase = TeaPurchase::create($validateData);

        $purchase->update([
            "tea_purchase_no"=> 'TP'.
            str_pad($purchase->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($purchase->tea->id,2,'0', STR_PAD_LEFT) .
            str_pad($purchase->id,4,'0', STR_PAD_LEFT),
        ]);

        $request = PaymentRequest::create([
            'amount' => $purchase->quantity * $purchase->tea->price_per_Kg,
            'supplier_id' => $purchase->supplier_id,
            'user_id' => $purchase->user_id,
        ]);

        $purchase->update([
            'payment_request_id' => $request->id,
        ]);

        $request->update([
            "request_no"=> 'REQ'.
            str_pad($request->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($request->supplier->id,2,'0', STR_PAD_LEFT) .
            str_pad($request->id,4,'0', STR_PAD_LEFT),
        ]);

        $notifyPaymentRequest = PaymentRequest::findOrFail($request->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Finance']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new TeaPaymentRequestNotification($notifyPaymentRequest));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        return redirect()->route('tea.purchase.index')->with('success','Sent tea purchase request successfully!');
    }

}
