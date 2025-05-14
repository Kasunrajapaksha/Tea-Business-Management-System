<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\User;
use App\Notifications\SupplierPaymentCompletedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupplierPaymentController extends Controller{
        public function index(){
        Gate::authorize('view',SupplierPayment::class);

        $payments = SupplierPayment::all();
        return view('finance.supplier-payment.index',compact('payments'));
    }

    public function create(PaymentRequest $request){
        Gate::authorize('create',SupplierPayment::class);

        return view('finance.supplier-payment.create',compact('request'));
    }

    public function store(PaymentRequest $request){
        Gate::authorize('create',SupplierPayment::class);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'transaction_reference' => ['required','max:255'],
        ]);

        $payment = SupplierPayment::create([
            'user_id' => $validateData['user_id'],
            'transaction_reference' => $validateData['transaction_reference'],
            'amount' => $request->amount,
            'payment_request_id' => $request->id,
            'supplier_id' => $request->supplier->id,
        ]);

        $payment->update([
            "payment_no"=> 'SPT'.
            str_pad($payment->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($payment->supplier->id,2,'0', STR_PAD_LEFT) .
            str_pad($payment->id,4,'0', STR_PAD_LEFT),
        ]);

        $request->update([
            'status' => 5,
            'approved_date' => now(),
        ]);

        $notifypayment = SupplierPayment::findOrFail($payment->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Tea']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new SupplierPaymentCompletedNotification($notifypayment));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        return redirect()->route('finance.supplier.payment.index')->with('success','Supplier payment complited!');
    }

}
