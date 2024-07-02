<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            font-size: 13px
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <th colspan="5" style="border: 1px solid #000; background:lightblue;">
                <strong>({{ @$data[0]->customer_name }}) Shipment Plan</strong>
            </th>
        </thead>
    </table>
    @php
        $quantityTotal = 0;
        $cbm_total = 0;
        $carton_total = 0;
    @endphp
    <table width="100%" cellpadding="5" border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Order #</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Cust.PO #</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Size</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Article#</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Qty</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>UOM</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>Pack</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>CTN</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>CBM</strong></th>
                <th style="border: 1px solid #000; background:lightgray;"><strong>TTL CBM</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td style="border: 1px solid #000;">{{ $item->perfoma_invoice_no_local }}</td>
                    <td style="border: 1px solid #000;">{{ $item->po_number }}</td>
                    <td style="border: 1px solid #000;">{{ $item->size_name }}</td>
                    <td style="border: 1px solid #000;">{{ $item->product_name }}</td>
                    <td style="border: 1px solid #000;">{{ $quantities[$item->id] }}</td>
                    <td style="border: 1px solid #000;">{{ $item->unit }}</td>
                    <td style="border: 1px solid #000;">{{ $item->pack }}</td>
                    <td style="border: 1px solid #000;">{{ $item->carton }}</td>
                    <td style="border: 1px solid #000;">{{ $item->cbm }}</td>
                    <td style="border: 1px solid #000;">{{ $item->carton * $item->cbm }}</td>
                </tr>
                @php
                    $quantityTotal += $quantities[$item->id];
                    $cbm_total += $item->carton * $item->cbm;
                    $carton_total += $item->carton;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <th style="border: 1px solid #000;"><strong>{{ $quantityTotal }}</strong></th>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <th style="border: 1px solid #000;"><strong>{{ $carton_total }}</strong></th>
                <td style="border: 1px solid #000;"></td>
                <th style="border: 1px solid #000;"><strong>{{ $cbm_total }}</strong></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>
