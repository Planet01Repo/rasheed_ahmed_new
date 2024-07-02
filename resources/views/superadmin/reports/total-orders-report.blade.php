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
            font-size: 10px;
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
            /* margin-right: 1000px; */
        }

        .bold {
            font-weight: bold;
        }

        .thick {
            border: 2px solid black;
        }

        .des {
            width: 100% !important;
        }

        .custom-style {
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
            <div class="head">
                <h3 class="yel">Total Orders</h3><br>
                @if (@$data[0]->title == null)
                    <h3 class="b">{{ @$data[0]->customer_company_name }}</h3>
                @else
                    <h3 class="b">{{ @$data[0]->title }}</h3>
                @endif
            </div>
            <table>
                <thead>
                    <tr class="bold thick">
                        <td class="custom-style">ORDER #</td>
                        <td>CUSTOMER PO #</td>
                        <td class="custom-style">DATED</td>
                        <td>CUSTOMER NAME</td>
                        <td>CUSTOMER CODE</td>
                        <td>ACCEPTED DATE </td>
                        <td class="des">DESCRIPTION OF GOODS</td>
                        <td>SIZE</td>
                        <td>ARTICLE#</td>
                        <td>ORDER QTY.</td>
                        <td>UOM</td>
                        <td>PACK CTN</td>
                        <td># OF CTNS</td>
                        <td> UNIT PRICE</td>
                        <td>CURRENCY</td>
                        <td>TOTAL PRICE</td>
                        <td>PROCESSED AT</td>
                        <td> CBM CTN</td>
                        <td> TOTAL CBM</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $price = 0;
                        $total_price = 0;
                        $cbm = 0;
                        $total_cbm = 0;
                    @endphp
                    @foreach ($data as $item)
                        @php
                            $price = $item->total_price;
                            $total_price += $price;
                            $cbm = $item->total_cbm;
                            $total_cbm += $cbm;
                        @endphp
                        <tr>
                            <td>{{ @$item->perfoma_invoice_no_local }} </td>
                            <td>{{ @$item->po_number }}</td>
                            <td>{{ @$item->pi_date }}</td>
                            <td>{{ @$item->customer_company_name }}</td>
                            <td>{{ @$item->customer_code }}</td>
                            <td>{{ @$item->accepted_date }}</td>
                            <td> </td>
                            <td>{{ @$item->size_name }}</td>
                            <td>{{ @$item->product_name }}</td>
                            <td>{{ @$item->quantity }}</td>
                            <td>{{ measurementUnit()[@$item->unit] }}</td>
                            <td>{{ number_format(@$item->no_of_carton) }}</td>
                            <td>{{ @$item->carton }} </td>
                            <td>{{ @$item->article_rate }}</td>
                            <td>{{ currency()[@$item->currency] }}</td>
                            <td>{{ number_format(@$item->total_price, 2) }}</td>
                            <td>{{ cities()[@$item->processed_at] ?? 'N/A' }}</td>
                            <td>{{ number_format(@$item->cbm, 3) }}</td>
                            <td>{{ number_format(@$item->carton * @$item->cbm, 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" bold thick">{{ number_format(@$total_price, 2) }}</td>
                        <td></td>
                        <td></td>
                        <td class=" bold thick">{{ number_format(@$total_cbm, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
