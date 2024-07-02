<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Invoice</title>
    <style>
        * {
            border-collapse: collapse;
        }

        td {
            text-align: center;
            border: 1px solid black;
            height: 20px;
            padding-top: 3px; 
        }
        .font {
            font-size: 14px;
        }
        .thick {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="table-data">
        <div class="container">
            <div class="head">
                <h3 style="text-align: center" class="yel">Receivable Report</h3>
            </div>
            <table>
                <thead>
                    <tr class="bold thick">
                        {{-- <td>CO.</td> --}}
                        <td>CUSTOMER</td>
                        <td>Invoice #</td>
                        <td style="width: 80px">Bol Date</td>
                        <td>Amount</td>
                        <td>Currency </td>
                        <td style="width: 80px">Due Date</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currency = currency();
                    @endphp
                    @foreach ($data->groupBy('company_id') as $detail)
                    {{-- @dd($detail) --}}
                        @php
                            $price = 0;
                            $total_price = 0;
                            $cbm = 0;
                            $total_cbm = 0;
                        @endphp
                        <tr>
                            <td colspan="6">Company. <b>{{ @$detail[0]->title }}</b> </td>
                        </tr>
                        @foreach ($detail as $item)
                            <tr>
                                {{-- <td>{{ @$item->title }} </td> --}}
                                <td class="font">{{ @$item->customer_company_name }}</td>
                                <td>{{ @$item->invoice_no }}</td>
                                <td>{{ @$item->awb_date }}</td>
                                <td>{{ number_format(@$item->total_amount, 2) }}</td>
                                <td>{{ $currency[@$item->currency] }}</td>
                                <td>{{ @$item->due_date }}</td>
                            </tr>
                            @php
                                $total_price += (float) $item->total_amount * (float) $request[$currency[$item->currency]];
                            @endphp
                        @endforeach
                        <tr>
                            {{-- <td> </td> --}}
                            <td></td>
                            <td></td>
                            <td>PKR</td>
                            <td style="font-weight: bold">{{ number_format($total_price, 2) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td></td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
