<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header, .footer { text-align: center; }
        .no-border td { border: none; }
    </style>
</head>
<body>
    <br>
    <h2 class="header">PROFORMA INVOICE</h2>

    <table class="no-border">
        <tr>
            <td><strong>INVOICE NO : {{$invoice->invoice_no}} </strong>
            <br><br><br>
                Phone: 011 045 4550
                <br>
                Email: continental@gmail
            </td>

            <td><strong>CUSTOMER : {{ $orders->first()->customer->first_name.' '.$orders->first()->customer->last_name }} </strong>
            <br><br><br>
                Phone: {{ $orders->first()->customer->number}}
                <br>
                Email: {{ $orders->first()->customer->email}}
            </td>
        </tr>
    </table>

    <h5>WE CONFIRM HAVING SOLD TO YOU CEYLON TEA AS DESCRIBED BELOW;</h5>
    <br>
    <table id="main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ITEM NAME</th>
                <th>PACKING DESCRIPTION</th>
                <th>TOTAL KGS</th>
                <th>PER KG PRICE (USD)</th>
                <th>TOTAL VALUE (USD)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->orderItem->tea->tea_name . ' - ' . $order->orderItem->tea->tea_standard }}</td>
                    <td>{{ $order->packing_instractions }}</td>
                    <td>{{ number_format($order->orderItem->quantity, 1) }}</td>
                    <td>{{ number_format($order->orderItem->tea->price_per_Kg, 2) }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
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
    <br>
    <table id="second-table">
        <tr>
            <td><strong>Port of Loading : </strong></td>
            <td>{{ $orders->first()->shippingSchedule->departure_port }}</td>
        </tr>
        <tr>
            <td><strong>Date of Shipment : </strong></td>
            <td>{{ 'During the month of ' . \Carbon\Carbon::parse($orders->first()->shippingSchedule->departure_date)->format('F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Bank Details : </strong></td>
            <td>People's Bank, Colombo Branch, Account No: 5678901234</td>
        </tr>
    </table>
    <br><br>
    <table class="no-border">
        <tr>
            <td><strong>THE SELLER : </strong>CONTINENTAL TEA (PVT) LTD</td>
            <td><strong>DATE : </strong>{{ $invoice->issued_at }}</td>
        </tr>
    </table>

</body>
</html>
