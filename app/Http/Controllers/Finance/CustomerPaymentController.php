<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CustomerPayment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerPaymentController extends Controller
{

    public function index(){
        Gate::authorize('view',CustomerPayment::class);

        $customer_payments = CustomerPayment::latest()->paginate(8);

        return view('finance.customer-payment.index', compact('customer_payments'));
    }

    public function create(Order $order){
        Gate::authorize('create',CustomerPayment::class);

        if($order->status != 14 ){
            abort(404);
        }

        return view('finance.customer-payment.create',compact('order'));
    }


    public function store(){
        Gate::authorize('create',CustomerPayment::class);
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'proforma_invoice_id' => ['exists:proforma_invoices,id'],
            'paid_at' => ['required','date_format:Y-m-d'],
            'transaction_reference' => ['required'],
        ]);

        $customer_payment = CustomerPayment::create($validateData);

        $customer_payment->update([
            "customer_payment_no"=> 'CPN'.
            str_pad($customer_payment->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($customer_payment->proformaInvoice->id,2,'0', STR_PAD_LEFT) .
            str_pad($customer_payment->id,4,'0', STR_PAD_LEFT),
        ]);

        $order = Order::findOrFail($customer_payment->proformaInvoice->order->id);

        $order->update([
            'status' => 15,
        ]);

        return redirect()->route('order.show',$order)->with('success','Customer payment updated successfully!');
    }


    public function show(CustomerPayment $payment){
        Gate::authorize('view',CustomerPayment::class);
        return view('finance.customer-payment.show', compact('payment'));
    }


    public function edit(CustomerPayment $payment){
        Gate::authorize('update',$payment);
        return view('finance.customer-payment.edit', compact('payment'));
    }


    public function update(CustomerPayment $payment){
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'paid_at' => ['required','date_format:Y-m-d'],
            'transaction_reference' => ['required'],
        ]);

        $payment->update($validateData);

        return redirect()->route('finance.customer.payment.show',$payment)->with('success','Customer payment updated successfully!');
    }


    public function destroy(CustomerPayment $customerPayment)
    {
        //
    }
}
