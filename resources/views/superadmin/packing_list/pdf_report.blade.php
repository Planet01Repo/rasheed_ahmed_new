<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <title>Invoice</title>
    <style type="text/css">
        /* @page
   {
       margin-top: 250px !impotant;
       margin-bottom: 180px !impotant;
   } */
        header {
            position: fixed;
            left: 0px;
            top: -300px;
            right: 0px;
            height: 300px;
            text-align: center;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -220px;
            right: 0px;
            height: 220px;
        }

        body * {
            margin-bottom: 0;
        }

        body {
            font-family: 'Calibri', sans-serif;
        }

        .Table {
            width: 100%;
            display: table;
            font-size: 10px;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .Title {
            display: table-caption;
            text-align: center;
            font-weight: bold;
            font-size: larger;
        }

        .Heading {
            display: table-row;
            font-weight: bold;
            text-align: center;
        }

        .Row {
            display: table-row;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .Cell {
            display: table-cell;
            border: 1px solid;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .Cell-body {
            display: table-cell;
            border-left: 1px solid;
            border-right: 1px solid;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
            height: 15px;
        }

        .b-black {
            padding: 10px;
        }

        .b-black-for-goods {
            padding: 0px 10px 10px 10px;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #000;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 3px 10px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 3px 10px;
            word-break: normal;
        }

        .tg .tg-tdlr {
            background-color: #ffffff;
            border-color: #ffffff;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-wmqn {
            background-color: #ffffff;
            border-color: #ffffff;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg-new {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg-new td {
            border-style: solid;
            border-width: 0px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg-new th {
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg-new .tg-new-zv4m {
            text-align: left;
            vertical-align: top
        }

        .tg-new .tg-new-0pky {
            border-color: inherit;
            text-align: right;
            vertical-align: top;
            padding: 5px 5px 3px 10px
        }

        .tg-new th.tg-new-0pky {
            border-color: inherit;
            text-align: center;
            vertical-align: top;
            padding: 5px 5px 3px 10px
        }

        .tg-new .custom-left {
            border-color: inherit;
            text-align: left !important;
            vertical-align: top;
            padding: 5px 0px 3px 10px
        }

        /* .tg-new .tg-new-011pky {
        border-color: inherit;
        text-align: left;
        vertical-align: top;
        padding: 5px 3px 3px 3px
    } */


        table.tg-new {
            width: 100%;
        }

        table.tg-new tr td {
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }

        table.tg-new tfoot tr td {
            border-top: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }

        table.tg-new tr th {
            border: 1px solid #000;
        }

        table {
            font-size: 12px !important;
        }

        .font-10 {
            font-size: 10px !important;
        }
    </style>
</head>

<body>
    <header></header>
    <footer></footer>
    @if ($data->customer->company->title == 'Fine Grip Import Export')
        <style>
            @page {
                border: 1px solid;
                margin-top: 350px;
            }
        </style>
    @else
        <style>
            @page {
                border: 1px solid;
                margin-top: 200px;
            }
        </style>
    @endif
    <div class="border header-increase" style="border-bottom:none">
        <div class="border-bottom text-center">
            PACKING LIST
        </div>


        <table class="tg" width="100%">
            <thead>
                <tr>
                    <th class="tg-tdlr"><span style="font-weight:bold">Invoice No:</span>
                        {{ $header_detail['invoice_no'] }}</th>
                    <th class="tg-tdlr"><span style="font-weight:bold">Date: </span><span
                            style="font-weight:normal">{{ date('jS M, Y', strtotime($header_detail['date'])) }}</span></th>
                </tr>
                {{-- @dd($header_detail['date']) --}}
            </thead>
            <tbody>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Shipped Per:</span>
                        {{ $header_detail['shipped_per'] }}</td>
                    <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity:
                            {{ $header_detail['total_quantity'] }} PRS</span></td>
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">BL / AWB No:
                        </span>{{ $header_detail['awb_no'] }}
                        <span class="font-10" style="font-weight:bold">Date: {{ $header_detail['awb_date'] }}</span>
                    </td>
                    <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{ $header_detail['carton'] }}
                            CTN</span></td>
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">F.I No:</span> {{ $header_detail['form_no'] }}
                        <span class="font-10" style="font-weight:bold">Date:
                            {{ $header_detail['form_date'] }}
                        </span>
                    </td>
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: 0 CBM</span></td> --}}
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{@$total_volume}} CBM</span></td> --}}
                    <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{ $header_detail['cbm'] }}
                            CBM</span></td>
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Price Base:</span>
                        {{ $header_detail['price_base'] }}</td>
                    <td class="tg-tdlr"><span style="font-weight:bold">Payment terms: </span><span
                            style="font-weight:normal">{{ $header_detail['payment_terms'] }}</span></td>
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Bill To: </span><span
                            style="font-weight:normal">{{ $header_detail['bill_to'] }}</span></td>
                    <td class="tg-tdlr"><span style="font-weight:bold">Ship to: </span><span
                            style="font-weight:normal">{{ $header_detail['address'] }}</span></td>
                </tr>
                <tr>
                    {{-- <td class="tg-wmqn" colspan="2"><span style="font-weight:bold">Description of goods: </span><span style="font-weight:normal">Demo Description here. Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here</span></td> --}}
                    <td class="tg-wmqn" colspan="2"><span class="a" style="font-weight:bold">Description of
                            goods: </span><span class="a"
                            style="font-weight:normal">{{ $header_detail['description'] }}</span></td>
                </tr>
            </tbody>
        </table>



        <table class="tg-new">
            <thead>
                <tr>
                    <th class="tg-new-0pky"><span style="font-weight:bold">PO #</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">ARTICLE #</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">SIZE </span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">QTY</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">UOM</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">PACK</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold; padding-right:6px">CTN</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">CBM</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">NW/KG</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">GW/KG</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">CTN SERIAL</span></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @foreach ($mergedArray as $key => $item)
                    {{-- @dd($table_detail) --}}
                    {{-- @foreach ($abc as $a)
                        {{ $counter++ }}

                        @if ($counter < count($table_detail)) --}}
                    <tr class="description_rows">
                        <td class="tg-new-0pky custom-left">{{ @$item['po_no'] }}</td>
                        <td class="tg-new-0pky custom-left">{{ @$item['article_no'] }}</td>
                        <td class="tg-new-0pky custom-left">{{ @$item['size'] }}</td>
                        <td class="tg-new-0pky">{{ @number_format(@$item['quantity']) }}</td>
                        <td class="tg-new-0pky custom-left">{{ @$item['unit_of_measurement'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['individual_packing'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['carton'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['ind_cbm'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['net_weight'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['gross_weight'] }}</td>
                        <td class="tg-new-0pky">{{ @$item['carton_serial'] }}</td>
                    </tr>
                    {{-- @else
                        @break
                    @endif
                @endforeach --}}
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <th class="tg-new-0pky"><span
                            style="font-weight:bold">{{ $footer_detail['total_quantity'] }}</span></th>
                    <td class="tg-new-0pky custom-left" style="font-weight:bold">PRS</td>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"><span style="font-weight:bold">{{ $footer_detail['total_carton'] }}</span>
                    </td>
                    <th class="tg-new-0pky"><span style="font-weight:bold">{{ $footer_detail['total_cbm'] }}</span>
                    </th>
                    <td class="tg-new-0pky"><span
                            style="font-weight:bold">{{ $footer_detail['total_net_weight'] }}</span></td>
                    <td class="tg-new-0pky"><span
                            style="font-weight:bold">{{ $footer_detail['total_gross_weight'] }}</span></td>

                    <td class="tg-new-0pky"><span
                            style="font-weight:bold">{{ $footer_detail['total_carton_serial'] }}</span></td>
                </tr>
            </tfoot>

        </table>

        <style type="text/css">
            .border {
                border: 1px solid;
            }

            .border-bottom {
                border-bottom: 1px solid;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .grey {
                background-color: rgb(214, 213, 213);
            }
        </style>

</body>

</html>
