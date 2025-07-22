<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CustomerPayment;
use App\Models\Order;
use App\Models\ProformaInvoice;
use App\Models\User;
use App\Notifications\UpdateCustomerPaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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


    public function store(Request $request){
        Gate::authorize('create',CustomerPayment::class);
        $validateData = $request->validate([
            'user_id' => ['exists:users,id'],
            'proforma_invoice_id' => ['exists:proforma_invoices,id'],
            'paid_at' => ['required','date_format:Y-m-d','before_or_equal:today'],
            'transaction_reference' => ['required','string','unique:customer_payments,transaction_reference'],
            'total_amount' => ['required','numeric',],
            'payment_document' => ['required','file','mimes:pdf,jpeg,jpg,png','max:2048']
        ]);

        $invoice = ProformaInvoice::findOrFail($validateData['proforma_invoice_id']);
        if($validateData['paid_at'] < $invoice->issued_at){
            throw ValidationException::withMessages([
                "paid_at" => 'The paid date cannot be before the Proforma Invoice sent date.'
            ]);
        }

        if ($request->hasFile('payment_document')) {
            $filePath = $request->file('payment_document')->store('payment_documents', 'public');
            $validateData['payment_document'] = $filePath;
        }

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

        $users = User::whereHas('department', function($query){
        $query->whereIn('department_name',['Admin','Management','production','Marketing']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new UpdateCustomerPaymentNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

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


    public function update(Request $request, CustomerPayment $payment){
        $validateData = $request->validate([
            'user_id' => ['exists:users,id'],
            'paid_at' => ['required','date_format:Y-m-d'],
            'transaction_reference' => ['required','string', Rule::unique('customer_payments', 'transaction_reference')->ignore($payment->id)],
            'payment_document' => ['nullable','file','mimes:pdf,jpeg,jpg,png','max:2048']        ]);

        $invoice = ProformaInvoice::findOrFail($payment->proforma_invoice_id);
        if($validateData['paid_at'] < $invoice->issued_at){
            throw ValidationException::withMessages([
                "paid_at" => 'The paid date cannot be before the Proforma Invoice sent date.'
            ]);
        }

        if ($request->hasFile('payment_document')) {
            if ($payment->payment_document && file_exists(storage_path('app/public/' . $payment->payment_document))) {
                unlink(storage_path('app/public/' . $payment->payment_document));
            }

            $path = $request->file('payment_document')->store('payment_documents', 'public');
            $validateData['payment_document'] = $path;

        } else {

            $validateData['payment_document'] = $payment->payment_document;

        }

        $payment->fill($validateData);
        if ($payment->isDirty()) {
            $payment->save();
            return redirect()->route('finance.customer.payment.show',$payment)->with('success','Customer payment updated successfully!');
        }
        return redirect()->route('finance.customer.payment.edit',$payment);
    }




    public function download(CustomerPayment $payment){
        $file_path = storage_path("app/public/".$payment->payment_document);
        return response()->download($file_path);
    }
}
