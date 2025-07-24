<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\CommercialInvoice;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Port;
use App\Models\ProformaInvoice;
use App\Models\ShippingProvider;
use App\Models\ShippingSchedule;
use App\Models\User;
use App\Models\Vessel;
use App\Notifications\ReadyToShipNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CommercialInvoiceController extends Controller
{

    public function index(){
        $orders = Order::with(['customer'])->get();
        $groupedOrders = $orders->groupBy(function ($order) {
            return $order->customer->id;
        });
        return view('shipping.commercial-invoice.index',compact(['groupedOrders']));
    }

    public function show(Customer $customer, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::where('customer_id', $customer->id)->whereIn('id', $orderIds)->get();
        $providers = ShippingProvider::all();
        $vessels = Vessel::all();
        $ports = Port::where('country_id',$customer->country_id);
        $departurePorts = Port::where('port_name','LIKE','%Sri Lanka%')->get();

        return view('shipping.commercial-invoice.show',compact(['customer','orders','providers','ports','vessels','departurePorts']));
    }

    public function store(Customer $customer, $orders){

        $validateData = request()->validate([
            'shipping_provider_id' => ['exists:shipping_providers,id'],
            'vessel_id' => ['required', 'exists:vessels,id'],
            'departure_port' => ['required', 'exists:ports,port_name'],
            'arrival_port' => ['required', 'exists:ports,port_name'],
            'user_id' => ['exists:users,id'],
            'shipping_cost' => ['required','numeric', 'min:0'],
        ]);

        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();

        $invoice = CommercialInvoice::create([
            'user_id' => request()->user()->id,
            'issued_at' => now()->format('Y-m-d'),
            'shipping_cost' => $validateData['shipping_cost']
        ]);

        $invoice->update([
            "invoice_no"=> 'CIN'.
            str_pad($customer->id,2,'0', STR_PAD_LEFT)  .
            str_pad($invoice->user->id,2,'0', STR_PAD_LEFT) .
            str_pad($invoice->id,4,'0', STR_PAD_LEFT),
        ]);


        foreach ($orders as $key => $order) {
            $order->shippingSchedule->update([
                'shipping_provider_id' => $validateData['shipping_provider_id'],
                'vessel_id' => $validateData['vessel_id'],
                'departure_port' => $validateData['departure_port'],
                'arrival_port' => $validateData['arrival_port'],
                'user_id' => $validateData['user_id'],
            ]);

            $order->commercialInvoice()->sync($invoice->id);

            $order->update([
                'status' => 18 //ready to ship
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new ReadyToShipNotification($order));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }
        }

        return redirect()->back()->with('success','Commercial invoice created successfully!');

    }

    public function showPdf(CommercialInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        return view('shipping.commercial-invoice.invoice', compact('invoice','orders'));
    }

    public function generate(CommercialInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        $data = [
            'invoice' => $invoice,
            'orders' => $orders
        ];
        $pdf = Pdf::loadView('shipping.commercial-invoice.invoice', $data);
        return $pdf->download($invoice->invoice_no . '.pdf');
    }


}
