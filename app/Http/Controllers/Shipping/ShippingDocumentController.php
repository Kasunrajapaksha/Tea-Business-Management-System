<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\CommercialInvoice;
use App\Models\Order;
use App\Models\ShippingDocument;
use App\Models\User;
use App\Notifications\OrderDeliveredNotification;
use App\Notifications\ShippedToCustomerNotification;
use Illuminate\Http\Request;

class ShippingDocumentController extends Controller
{
    public function index(){
        $invoices =  CommercialInvoice::latest()->paginate(8);
        return view('shipping.document.index',compact('invoices'));
    }

    public function create(CommercialInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        return view('shipping.document.create',compact('invoice','orders'));
    }

    public function edit(CommercialInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        return view('shipping.document.edit',compact('invoice','orders'));
    }

    public function store($orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();


        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'commercial_invoice_id' => ['exists:commercial_invoices,id'],
            'bill_of_lading' => 'required|file|mimes:pdf|max:10240',
            'shipping_receipt' => 'required|file|mimes:pdf|max:10240',
            'packing_list' => 'required|file|mimes:pdf|max:10240',
            'freight_bill' => 'required|file|mimes:pdf|max:10240',
            'export_customs_clearance' => 'required|file|mimes:pdf|max:10240',
        ]);

        $invoice = CommercialInvoice::findOrFail($validateData['commercial_invoice_id']);

        $paths = [
            'bill_of_lading' => request()->file('bill_of_lading')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'bill_of_lading_' . time() . '.' . request()->file('bill_of_lading')->getClientOriginalExtension(),
                'public'
            ),
            'shipping_receipt' => request()->file('shipping_receipt')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'shipping_receipt_' . time() . '.' . request()->file('shipping_receipt')->getClientOriginalExtension(),
                'public'
            ),
            'packing_list' => request()->file('packing_list')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'packing_list_' . time() . '.' . request()->file('packing_list')->getClientOriginalExtension(),
                'public'
            ),
            'freight_bill' => request()->file('freight_bill')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'freight_bill_' . time() . '.' . request()->file('freight_bill')->getClientOriginalExtension(),
                'public'
            ),
            'export_customs_clearance' => request()->file('export_customs_clearance')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'export_customs_clearance_' . time() . '.' . request()->file('export_customs_clearance')->getClientOriginalExtension(),
                'public'
            ),
        ];

        ShippingDocument::create([
            'bill_of_lading' => $paths['bill_of_lading'],
            'shipping_receipt' => $paths['shipping_receipt'],
            'packing_list' => $paths['packing_list'],
            'freight_bill' => $paths['freight_bill'],
            'export_customs_clearance' => $paths['export_customs_clearance'],
            'commercial_invoice_id' => $validateData['commercial_invoice_id'],
            'user_id' => $validateData['user_id'],
        ]);

        foreach ($orders as $key => $order) {

            $order->update([
                'status' => 19 //shipped to customer
            ]);

            $order->shippingSchedule->update([
                'actual_departure_date' => now()->format('Y-m-d'),
                'user_id' => $validateData['user_id'],
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new ShippedToCustomerNotification($order));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        }

        return redirect()->route('shipping.invoice.show', ['customer' => $orders->first()->customer->id, 'orders' => $orders->pluck('id')->join(',')])->with('success','Shipping documents updated successfully!');

    }

    public function update(CommercialInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();

        $shipping_document = ShippingDocument::findOrFail($invoice->shippingDocument->id);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'proof_of_delivery' => 'required|file|mimes:pdf|max:10240',
            'delivery_receipt' => 'required|file|mimes:pdf|max:10240',
        ]);

        $paths = [
            'proof_of_delivery' => request()->file('proof_of_delivery')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'proof_of_delivery_' . time() . '.' . request()->file('proof_of_delivery')->getClientOriginalExtension(),
                'public'
            ),
            'delivery_receipt' => request()->file('delivery_receipt')->storeAs(
                'shipping_documents',
                $invoice->invoice_no. '-' . 'delivery_receipt_' . time() . '.' . request()->file('delivery_receipt')->getClientOriginalExtension(),
                'public'
            ),
        ];

        $shipping_document->update([
            'proof_of_delivery' => $paths['proof_of_delivery'],
            'delivery_receipt' => $paths['delivery_receipt'],
        ]);

        foreach ($orders as $key => $order) {

            $order->update([
                'status' => 20 //Order Delivered
            ]);

            $order->shippingSchedule->update([
                'actual_arrival_date' => now()->format('Y-m-d'),
                'user_id' => $validateData['user_id'],
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new OrderDeliveredNotification($order));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        }

        return redirect()->route('shipping.invoice.show', ['customer' => $orders->first()->customer->id, 'orders' => $orders->pluck('id')->join(',')])->with('success','Shipping documents updated successfully!');

    }



    public function show(CommercialInvoice $invoice){
        return view('shipping.document.show',compact('invoice'));
    }

    public function download(ShippingDocument $document,$file){
        if ($file === 'bill_of_lading') {
            $file_path = storage_path("app/public/".$document->bill_of_lading);
        }elseif ($file === 'shipping_receipt') {
            $file_path = storage_path("app/public/".$document->shipping_receipt);
        }elseif ($file === 'packing_list') {
            $file_path = storage_path("app/public/".$document->packing_list);
        }elseif ($file === 'freight_bill') {
            $file_path = storage_path("app/public/".$document->freight_bill);
        }elseif($file === 'export_customs_clearance') {
            $file_path = storage_path("app/public/".$document->export_customs_clearance);
        }elseif($file === 'proof_of_delivery') {
            $file_path = storage_path("app/public/".$document->proof_of_delivery);
        }elseif($file === 'delivery_receipt') {
            $file_path = storage_path("app/public/".$document->delivery_receipt);
        }
        return response()->download($file_path);
    }
}
