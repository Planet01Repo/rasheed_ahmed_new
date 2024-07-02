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

        }

        .b {
            background-color: rgb(14, 180, 246);
        }

        .g {
            background-color: rgb(181, 227, 181);
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
            margin-top: 500px;
            margin-right: 500px;
        }

        .bold {
            font-weight: bold;
        }

        .thick {
            border: 2px solid black;
        }

        /* .head {
    margin-bottom: 50px;
} */
    </style>
</head>

<body>
    @foreach ($customer as $value)
        <div style="font-weight:bold; margin-top:10px;">
            {{ $value->customer_company_name }}
        </div>
        <table>
            <thead>
                {{-- <tr>
                <td colspan="2" style="border: 1px solid #000; background:yellow;"><strong> Order Status</strong></td>
            </tr> --}}
                {{-- <tr>
                @if (@$data[0]->name != null)
                <td colspan="3" style="border: 1px solid #000; background:lightblue;">
                        <strong>{{ @$data[0]->customer_company_name }}</strong>
                    </td>
                    @else
                    <td colspan="3" style="border: 1px solid #000; background:lightblue;">
                        <strong>{{ @$data[0]->title }}</strong>
                    </td>
                @endif
            </tr> --}}
            </thead>
        </table>
        <table>
            <thead>
                <tr class="bold thick">
                    <td colspan="2" style="border: 1px solid #000; background:lightgray;"><strong>ORDER #</strong>
                    </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>CUSTOMER PO #</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>ACCEPTED DATE</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>SIZE</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>ARTICLE#</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>ORDER QTY.</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>UOM</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>QTY. PAIRS</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>SHIPPED</strong></td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>BALANCE</strong></td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>PACK</strong></td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>CTN</strong></td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>CBM CTN</strong> </td>
                    <td style="border: 1px solid #000; background:lightgray;"><strong>TOTAL CBM</strong> </td>
                </tr>
            </thead>
            <tbody>
                @php
                    $cbm = 0;
                    $total_cbm = 0;
                @endphp
                @foreach ($data as $item)
                    @if ($item->customer_id == $value->id)
                        @php
                            $cbm = $item->total_cbm;
                            $total_cbm += $cbm;
                            $balance = @$item->quantity_pairs - @$item->shipped;
                            $carton = @$balance / @$item->pack;
                        @endphp
                        @if ($balance != 0)
                            <tr>
                                <td colspan="2" style="border: 1px solid #000;">
                                    {{ @$item->perfoma_invoice_no_local }}
                                </td>
                                <td style="border: 1px solid #000;">{{ @$item->po_number }}</td>
                                <td style="border: 1px solid #000;">{{ @$item->accepted_date }}</td>
                                <td style="border: 1px solid #000;">{{ @$item->size_name }}</td>
                                <td style="border: 1px solid #000;">{{ @$item->product_name }}</td>
                                <td style="border: 1px solid #000;">{{ number_format(@$item->order_quantity) }}</td>
                                <td style="border: 1px solid #000;">{{ measurementUnit()[@$item->unit] }}</td>
                                <td style="border: 1px solid #000;">{{ number_format(@$item->quantity_pairs) }} </td>
                                <td style="border: 1px solid #000;">{{ number_format(@$item->shipped) }}</td>
                                <td style="border: 1px solid #000;">{{ number_format(@$balance) }}
                                </td>
                                <td style="border: 1px solid #000;">{{ @$item->pack }}</td>
                                <td style="border: 1px solid #000;">{{ @$carton }}</td>
                                <td style="border: 1px solid #000;">{{ number_format(@$item->cbm, 3) }}</td>
                                <td style="border: 1px solid #000;">{{ number_format(@$carton * @$item->cbm, 3) }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
