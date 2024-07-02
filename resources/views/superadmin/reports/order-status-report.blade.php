<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Invoice</title>
    <style>
        /* table{
    border: 1px solid black;
} */
        * {
            border-collapse: collapse;
        }

        td {
            text-align: center;
            border: 1px solid black;
            font-size: 12px;
        }

        .b {
            background-color: rgb(14, 180, 246);
        }

        .g {
            background-color: rgb(181, 227, 181);
        }

        @page {
            margin-left: 28px;
        }

        .fat {
            background-color: rgb(208, 208, 208);
            border: 3px solid black;
            font-weight: bold;

        }

        h3 {
            border: 1px solid black;
            display: inline;

        }

        .yel {
            background-color: yellow;
            color: red;
        }

        .table-data {
            margin-right: 400px;
        }

        .bold {
            font-weight: bold;
        }

        .thick {
            border: 2px solid black;
        }

        .custom-align {
            padding: 10px;
        }

        /* .head {
    margin-bottom: 50px;
} */
    </style>
</head>

<body>
    <div class="table-data">
        <div class="container">
            <h3 class="yel">Order Status</h3><br>
            @foreach ($customer as $value)
                <div style="font-weight:bold; margin-top:10px;">
                    {{ $value->customer_company_name }}
                </div>
                {{-- <div class="head">
                    @if (@$data[0]->name != null)
                        <h3 class="b">{{ @$data[0]->customer_company_name }}</h3>
                    @else
                        <h3 class="b">{{ @$data[0]->title }}</h3>
                    @endif
                </div> --}}
                <table>
                    <thead>
                        <tr class="bold thick">
                            <td class="custom-align">ORDER #</td>
                            <td>CUSTOMER PO #</td>
                            <td>ACCEPTED DATE</td>
                            <td>SIZE</td>
                            <td>ARTICLE#</td>
                            <td>ORDER QTY.</td>
                            <td>UOM</td>
                            <td>QTY. PAIRS</td>
                            <td>SHIPPED</td>
                            <td>BALANCE</td>
                            <td>PACK</td>
                            <td>CTN</td>
                            <td> CBM CTN</td>
                            <td> TOTAL CBM</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cbm = 0;
                            $total_cbm = 0;
                            @$sum_balance = 0;
                        @endphp
                        @foreach ($data as $item)
                            @if ($item->customer_id == $value->id)
                                @php
                                    @$cbm = $item->total_cbm;
                                    @$total_cbm += $cbm;
                                    @$balance = @$item->quantity_pairs - @$item->shipped;
                                    @$sum_balance += $balance;
                                    @$carton = @$balance / @$item->pack;
                                @endphp
                                @if (@$balance != 0)
                                    <tr>
                                        <td>{{ @$item->perfoma_invoice_no_local }} </td>
                                        <td>{{ @$item->po_number }}</td>
                                        <td>{{ @$item->accepted_date }}</td>
                                        <td>{{ @$item->size_name }}</td>
                                        <td>{{ @$item->product_name }}</td>
                                        <td>{{ number_format(@$item->order_quantity) }}</td>
                                        <td>{{ measurementUnit()[@$item->unit] }}</td>
                                        <td>{{ number_format(@$item->quantity_pairs) }} </td>
                                        <td>{{ number_format(@$item->shipped) }}</td>
                                        <td>{{ number_format(@$balance) }}</td>
                                        <td>{{ number_format(@$item->pack) }}</td>
                                        <td>{{ number_format(@$carton) }}</td>
                                        <td>{{ number_format(@$item->cbm, 3) }}</td>
                                        <td>{{ number_format(@$carton * @$item->cbm, 3) }}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bold thick">
                            <td colspan="9">Total Balance</td>
                            <td class="bold thick">{{ number_format($sum_balance) }}</td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            @endforeach
        </div>
    </div>
</body>

</html>
