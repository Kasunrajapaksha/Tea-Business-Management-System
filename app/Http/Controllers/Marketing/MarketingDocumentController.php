<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProformaInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MarketingDocumentController extends Controller
{
    public function index(){
        $invoices =  ProformaInvoice::latest()->paginate(8);
        return view('marketing.document.index',compact('invoices'));
    }

    public function show(ProformaInvoice $invoice){
        return view('marketing.document.show',compact('invoice'));
    }

    public function showPdf(ProformaInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        return view('marketing.document.invoice', compact('invoice','orders'));
    }

    public function generate(ProformaInvoice $invoice, $orders){
        $orderIds = explode(',', $orders);
        $orders = Order::whereIn('id', $orderIds)->get();
        $data = [
            'invoice' => $invoice,
            'orders' => $orders
        ];
        $pdf = Pdf::loadView('marketing.document.invoice', $data);
        return $pdf->download($invoice->invoice_no . '.pdf');
    }
}
