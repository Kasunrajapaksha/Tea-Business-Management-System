<?php

namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\MaterialPurchase;
use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\TeaPurchase;
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
        //authorizetion
        Gate::authorize('create',SupplierPayment::class);
        Gate::authorize('create',InventoryTransaction::class);

        //validation
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'transaction_reference' => ['required','max:255'],
            'paid_at' => ['required','date'],
        ]);

        //create supplier payment
        $payment = SupplierPayment::create([
            'user_id' => $validateData['user_id'],
            'transaction_reference' => $validateData['transaction_reference'],
            'paid_at' => $validateData['paid_at'],
            'amount' => $request->amount,
            'payment_request_id' => $request->id,
            'supplier_id' => $request->supplier->id,
        ]);

        //create inventory transaction
        InventoryTransaction::create([
            'transaction_type' => 1, //add
            'item_type' => $request->supplier->type,
            'material_purchase_id' => $request->material_perchese ? $request->material_perchese->id : null,
            'tea_purchase_id' => $request->tea_perchese ? $request->tea_perchese->id : null,
            'tea_id' => $request->tea_perchese ? $request->tea_perchese->tea_id : null,
            'material_id' => $request->material_perchese ? $request->material_perchese->material_id : null,
            'supplier_id' => $request->supplier->id,

        ]);

        //update supplier payment no
        $payment->update([
            "payment_no"=> 'SPT'.
            str_pad($payment->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($payment->supplier->id,2,'0', STR_PAD_LEFT) .
            str_pad($payment->id,4,'0', STR_PAD_LEFT),
        ]);

        //update payment request
        $request->update([
            'status' => 5,
        ]);

        //notify users
        $notifypayment = SupplierPayment::findOrFail($payment->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Tea','Warehouse']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new SupplierPaymentCompletedNotification($notifypayment));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        //return view
        return redirect()->route('finance.supplier.payment.index')->with('success','Supplier payment completed!');
    }

}
