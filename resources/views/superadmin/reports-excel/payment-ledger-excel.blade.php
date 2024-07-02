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
                <td colspan="2" style="border: 1px solid #000; background:yellow;"><strong> PAYMENT LEDGER</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid #000; background:lightblue;">
                    @if (@$data[0]->name != null)
                        <h3 class="b">{{ $data[0]->customer_company_name }}</h3>
                    @endif
                </td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr class="bold thick">
                <td style="border: 1px solid #000; background:lightgray;"><strong> Invoice #</strong></td>
                <td colspan="2" style="border: 1px solid #000; background:lightgray;"><strong> BOL DATE</strong></td>
                <td style="border: 1px solid #000; background:lightgray;"><strong> AMOUNT</strong></td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>CURRENCY</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>DUE DATE</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>PAYMENT RECEIVED</strong> </td>
                <td style="border: 1px solid #000; background:lightgray;"><strong>BALANCE</strong> </td>
            </tr>
        </thead>
        <tbody>
            @php
                $sum_balance = 0;
            @endphp
            @foreach ($data as $item)
                @php
                    $sum_balance += @$item->balance;
                @endphp
                <tr>
                    <td style="border: 1px solid #000;">{{ @$item->invoice_no }} </td>
                    <td colspan="2" style="border: 1px solid #000;">{{ @$item->awb_date }} </td>
                    <td style="border: 1px solid #000;">{{ @$item->amount }}</td>
                    <td style="border: 1px solid #000;">{{ currency()[@$item->currency] }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->due_date ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->payment_received ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->balance }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid #000;" colspan="7"></td>
                <td style="border: 1px solid #000;">{{ $sum_balance }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
