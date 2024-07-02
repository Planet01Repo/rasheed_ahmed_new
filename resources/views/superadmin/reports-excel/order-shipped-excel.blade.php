<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Invoice</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td colspan="2" style="border: 1px solid #000; background:yellow;"><strong> ORDER SHIPPED</strong></td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid #000; background:lightblue;"><strong> NAME OF
                        CUSTOMER</strong></td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr class="bold thick">
                <td style="border: 1px solid #000; background:lightgray;"><strong> Invoice #</strong></td>
                <td colspan="2" style="border: 1px solid #000; background:lightgray;"><strong> Order #</strong></td>
                <td style="border: 1px solid #000; background:lightgray;"><strong> CUSTOMER PO #</strong></td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>SIZE</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>ARTICLE#</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>Quantity.</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>UOM</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>Currency</strong> </td>
                <td colspan="2" style="border: 1px solid #000; background:lightgray;"><strong>Amount</strong> </td>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
                $total_quantity = 0;
            @endphp
            @foreach ($data as $item)
                @php
                    $total_amount += @$item->total;
                    if (@$item->unit == 7) {
                        $total_quantity = $total_quantity + $item->quantity / 2;
                    } elseif (@$item->unit == 8) {
                        $total_quantity = $total_quantity + $item->quantity * 12;
                    } else {
                        $total_quantity = $total_quantity + $item->quantity;
                    }
                @endphp
                <tr>
                    <td style="border: 1px solid #000;">{{ @$item->invoice_no }} </td>
                    <td colspan="2" style="border: 1px solid #000;">{{ @$item->perfoma_invoice_no_local }} </td>
                    <td style="border: 1px solid #000;">{{ @$item->po_number }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->size }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->product_name }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->quantity }}</td>
                    <td style="border: 1px solid #000;">{{ measurementUnit()[@$item->unit] }}</td>
                    <td style="border: 1px solid #000;">{{ currency()[@$item->currency] }}</td>
                    <td colspan="2" style="border: 1px solid #000;">{{ @$item->total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid #000;" colspan="6"></td>
                <td style="border: 1px solid #000;">{{ $total_quantity }}</td>
                <td style="border: 1px solid #000;">PRS</td>
                <td style="border: 1px solid #000;" colspan="1"></td>
                <td style="border: 1px solid #000;" colspan="2">{{ @number_format($total_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
