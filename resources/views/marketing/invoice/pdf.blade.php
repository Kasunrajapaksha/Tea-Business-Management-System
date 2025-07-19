<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>PROFORMA INVOICE - {{ $invoice->invoice_no }}</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 100px 10px 10px 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }


        #main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        #main-table thead {
            background-color: #111111;
            color: #fff;
        }

        #main-table thead th {
            padding: 12px 15px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }

        #main-table tbody td {
            padding: 10px 15px;
            text-align: left;
            font-size: 13px;
            border: 1px solid #ddd;
        }

        #main-table tbody th {
            font-weight: bold;
        }

        #main-table th, #main-table td {
            border: 1px solid #ddd;
        }

        #info-table, #second-table, #bottom-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }



    </style>

</head>
<body>
    <div>
        <h2>PROFORMA INVOICE</h2>

        <table id="info-table">
            <tr>
                <td><strong>INVOICE NO : </strong> {{$invoice->invoice_no}}</td>
                <td><strong>CUSTOMER : </strong> {{ $invoice->order->customer->first_name . ' ' .$invoice->order->customer->last_name }}</td>
            </tr>
        </table>

        <h5>WE CONFIRM HAVING SOLD TO YOU CEYLON TEA AS DESCRIBED BELOW;</h5>
    </div>

    <table id="main-table">
        <thead>
            <tr>
                <th>ITEM NAME</th>
                <th>PACKING DESCRIPTION</th>
                <th>TOTAL KGS</th>
                <th>PER KG PRICE (USD)</th>
                <th>TOTAL VALUE (USD)</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $invoice->order->orderItem->tea->tea_name . ' - ' . $invoice->order->orderItem->tea->tea_standard }}</td>
                    <td>{{ $invoice->order->packing_instractions }}</td>
                    <td>{{ number_format($invoice->order->orderItem->quantity) }}</td>
                    <td>{{ number_format($invoice->order->orderItem->tea->price_per_Kg,2) }}</td>
                    <th>{{ number_format($invoice->order->total_amount,2) }}</th>
                </tr>
        </tbody>
    </table>


    <table id="second-table">
        <tr>
            <td><strong>Port of Loading : </strong></td>
            <td>{{ $invoice->order->shippingSchedule->departure_port }}</td>
        </tr>
        <tr>
            <td><strong>Date of Shipment : </strong></td>
            <td>{{ 'During the month of ' . \Carbon\Carbon::parse($invoice->order->shippingSchedule->departure_date)->format('F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Bank Details : </strong></td>
            <td>People's Bank, Colombo Branch, Account No: 5678901234</td>
        </tr>
    </table>

    <table id="bottom-table">
        <tr>
            <td><strong>THE SELLER : </strong>CONTINENTAL TEA (PVT) LTD</td>
            <td><strong>DATE : </strong>{{ $invoice->issued_at }}</td>
        </tr>
    </table>

</body>
</html>
