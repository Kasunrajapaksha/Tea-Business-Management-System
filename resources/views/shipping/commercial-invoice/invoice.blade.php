<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header, .footer { text-align: center; }
        .no-border td { border: none; }
    </style>
</head>
<body>

    <h2 class="header">COMMERCIAL INVOICE</h2>

    <table class="no-border">
        <tr>
            <td><strong>Exporter: Continental Tea</strong>
                <br><br>
                Phone: 011 045 4550
                <br>
                Email: continental@gmail
            </td>
            <td><strong>Importer: {{ $orders->first()->customer->first_name.' '.$orders->first()->customer->last_name}}</strong>
                <br>
                <br>
                Phone: {{ $orders->first()->customer->number}}
                <br>
                Email: {{ $orders->first()->customer->email}}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Invoice No:</th>
            <td>{{ $invoice->invoice_no}}</td>
            <th>Date:</th>
            <td>{{ $invoice->issued_at}}</td>
        </tr>
        <tr>
            <th>Port of Loading:</th>
            <td>{{ $orders->first()->shippingSchedule->departure_port}}</td>
            <th>Port of Discharge:</th>
            <td>{{ $orders->first()->shippingSchedule->arrival_port}}</td>
        </tr>
        <tr>
            <th>Vessel No:</th>
            <td>{{ $orders->first()->shippingSchedule->vessel->tracking_number}}</td>
            <th>Net Weight:</th>
        <td>
            @php
                $totalQuantity = 0;
                foreach ($orders as $order) {
                    $totalQuantity += $order->orderItem->quantity; // Sum the quantities of order items for each order
                }
            @endphp
            {{ number_format($totalQuantity,1).' kg' }}
        </td>
</tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description of Goods</th>
                <th>HS Code</th>
                <th>Quantity (kg)</th>
                <th>Unit Price (USD) </th>
                <th>Total (USD) </th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->orderItem->tea->tea_name}}</td>
                    <td>{{ $order->orderItem->tea->tea_standard}}</td>
                    <td>{{ number_format($order->orderItem->quantity,1) }}</td>
                    <td>{{ number_format($order->orderItem->tea->price_per_Kg,1) }}</td>
                    <td>{{ number_format($order->total_amount,2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Grand Total:</th>
                <th>{{ number_format($orders->sum('total_amount'),2)}}</th>
            </tr>
        </tfoot>
    </table>

    <p><strong>Declaration:</strong><br>
    We hereby certify that the information contained in this invoice is true and correct and that the contents of this shipment are as stated above.</p>

    <br><br>

    <div style="text-align:right;">
        Authorized Signature:<br><br><br>
        ____________________________<br>

    </div>

    <p class="footer" style="text-align:left;">Thank you for doing business with us.</p>

</body>
</html>
