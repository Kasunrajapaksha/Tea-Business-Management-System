<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProformaInvoice;
use App\Models\User;
use App\Notifications\UpdateProductionPlanNotification;
use App\Notifications\UpdateProformaInvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
 use Barryvdh\DomPDF\Facade\Pdf;

class ProformaInvoiceController extends Controller{

    public function index(){
        Gate::authorize('view', ProformaInvoice::class);
        $invoices = ProformaInvoice::latest()->paginate(5);
        return view('marketing.invoice.index', compact('invoices'));
    }

    public function create(Order $order){
        Gate::authorize('create', ProformaInvoice::class);

        if($order->status != 13 ){
            abort(404);
        }

        return view('marketing.invoice.create',compact('order'));
    }

    public function store(Order $order){
        Gate::authorize('create', ProformaInvoice::class);
        $invoice = ProformaInvoice::create([
            'order_id' => $order->id,
            'user_id' => request()->user()->id,
            'issued_at' => now()->format('Y-m-d'),
        ]);

        $invoice->update([
            "invoice_no"=> 'PIN'.
            str_pad($order->customer->id,2,'0', STR_PAD_LEFT)  .
            str_pad($order->user->id,2,'0', STR_PAD_LEFT) .
            str_pad($invoice->id,4,'0', STR_PAD_LEFT),
        ]);

        $order->update([
            'status' => 14,
        ]);

        $users = User::whereHas('department', function($query){
        $query->whereIn('department_name',['Admin','Management','Finance']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new UpdateProformaInvoiceNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        return redirect()->route('marketing.invoice.index')->with('success', 'The proforma nvoice created successfuly!');
    }

    public function show(ProformaInvoice $invoice){
        Gate::authorize('view', ProformaInvoice::class);
        $order = Order::findOrFail($invoice->order_id);
        return view('marketing.invoice.pdf', compact('invoice','order'));
    }

    public function generate(ProformaInvoice $invoice){
        Gate::authorize('view', ProformaInvoice::class);

        $data = [
            'invoice' => $invoice
        ];
        $pdf = Pdf::loadView('marketing.invoice.pdf', $data);
        return $pdf->download($invoice->invoice_no . '.pdf');
    }

    public function edit(ProformaInvoice $proformaInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProformaInvoice $proformaInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProformaInvoice $proformaInvoice)
    {
        //
    }
}
