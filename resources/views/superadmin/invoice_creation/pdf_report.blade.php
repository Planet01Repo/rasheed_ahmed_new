<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <title>Invoice</title>
    <style type="text/css">
        @page {
            margin-top: 250px !impotant;
            margin-bottom: 150px !impotant;
        }

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
            text-align: left;
            vertical-align: top;
            padding: 5px 0px 3px 10px
        }

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
    </style>
</head>

<body>
    <header></header>
    <footer></footer>
    @if ($data->customer->company->title == 'Fine Grip Import Export')
        <style>
            /* .header-increase {
        border:1px solid;
        margin-top: 100px;
      } */
            @page {
                margin-top: 320px;
                border: 1px solid;
            }
        </style>
    @else
        <style>
            .border {
                border: 1px solid;
            }
        </style>
    @endif
    <div class="border header-increase" style="border-bottom:none;">
        <div class="border-bottom text-center">
            COMMERCIAL INVOICE
        </div>

        <table class="tg" width="100%">
            <thead>
                <tr>
                    <th class="tg-tdlr"><span style="font-weight:bold">Invoice No:</span> {{ @$data->invoice_no }}</th>
                    <th class="tg-tdlr"><span style="font-weight:bold">Date: </span><span style="font-weight:normal">
                            @php
                                $total_quantity = 0;
                                echo date('jS M, Y', strtotime(@$data->created_at));
                            @endphp
                        </span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Shipped Per:</span> {{ @$data->shipped_per }}
                    </td>
                    @foreach ($detail_data as $key => $item)
                        @php
                            if (@$item->perfomaInvoiceDetail->unit == '7') {
                                $total_quantity = $total_quantity + $item->quantity / 2;
                                //  echo (int)$item->quantity / 2;
                            } elseif (@$item->perfomaInvoiceDetail->unit == '8') {
                                $total_quantity = $total_quantity + $item->quantity * 12;
                                //  echo (int)$item->quantity * 12;
                            } else {
                                $total_quantity = $total_quantity + $item->quantity;
                            }
                        @endphp
                    @endforeach
                    <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity:
                            {{ @number_format($total_quantity) }} PRS</span></td>
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity: {{@$data->quantity}} PRS</span></td> --}}
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">BL / AWB No: </span>{{ @$data->awb_no }} <span
                            style="font-weight:bold">Date:
                            @php
                                $date = date_create(@$data->awb_date);
                                echo date_format($date, 'jS M, Y');
                            @endphp
                        </span></td>
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{@$detail_data->sum('carton')}} CTN</span></td> --}}
                    <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{ @$total_carton }} CTN</span>
                    </td>
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">F.I No:</span> {{ @$data->form_no }} <span
                            style="font-weight:bold">Date:
                            @php
                                $date = date_create(@$data->form_date);
                                echo date_format($date, 'jS M, Y');
                            @endphp
                        </span></td>
                    <td class="tg-tdlr"><span style="font-weight:bold">Payment terms: </span><span
                            style="font-weight:normal">{{ @$data->customer->payment_terms }}</span></td>
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: 0 CBM</span></td> --}}
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume:
                            {{ @number_format($total_volume, 2) }} CBM</span></td> --}}
                    {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{@$data->volume}} CBM</span></td> --}}
                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Price Base:</span>
                        {{ @$data->customer->price_base }}</td>

                </tr>
                <tr>
                    <td class="tg-tdlr"><span style="font-weight:bold">Bill To: </span><span
                            style="font-weight:normal">{{ @$data->customer->bill_to }}</span></td>
                    @if (@$data->ship_to != null)
                        <td class="tg-tdlr"><span style="font-weight:bold">Ship To: </span><span
                                style="font-weight:normal">{{ @$data->ship_to }}</span></td>
                    @else
                        <td class="tg-tdlr"></td>
                    @endif
                </tr>
                <tr>
                    {{-- <td class="tg-wmqn" colspan="2"><span style="font-weight:bold">Description of goods: </span><span style="font-weight:normal">Demo Description here. Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here</span></td> --}}
                    <td class="tg-wmqn" colspan="2"><span class="a" style="font-weight:bold">Description of
                            goods: </span><span class="a"
                            style="font-weight:normal">{{ @$data->description }}</span></td>
                </tr>
            </tbody>
        </table>



        <table class="tg-new">
            <thead>
                <tr>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Our Order #</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Customer PO#</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">H.S Code</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Article No.</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Size </span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Quantity</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">UOM</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">U/Price</span></th>
                    <th class="tg-new-0pky"><span style="font-weight:bold">Amount
                            {{ currency()[@$data->customer->currency] }}</span></th>
                    {{-- <th class="tg-new-0pky"><span style="font-weight:bold">Sub Total</span></th> --}}
                    {{-- <th class="tg-new-0pky"><span style="font-weight:bold">Nt. Wt.KG.</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Gr. Wt.KG</span></th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $amount = 0.0;
                    $total_amount = 0.0;
                    $total_quantity = 0;
                    // $net_weight = 0;
                    // $total_net_weight = 0;
                    // $gross_weight = 0;
                    // $total_gross_weight = 0;
                @endphp
                @foreach ($detail_data as $key => $item)
                    @php
                        $amount = @sprintf('%.3f', @$item->quantity) * @sprintf('%.3f', @$item->perfomaInvoiceDetail->article_rate);
                        $total_amount += $amount;

                        // $net_weight = $carton_list[$key] * @$item->perfomaInvoiceDetail->product->net_weight_per_carton;
                        // $total_net_weight += $net_weight;

                        // $gross_weight = $carton_list[$key] * @$item->perfomaInvoiceDetail->product->gross_weight_per_carton;
                        // $total_gross_weight += $gross_weight;

                    @endphp
                    {{-- @foreach ($detail_data as $key => $item)
          @php

            if (@$item->perfomaInvoiceDetail->unit = 'DZP') {
              $item->quantity * 12;
            }

            elseif (@$item->perfomaInvoiceDetail->unit = 'PCS') {
              $item->quantity / 2;
            }
          @endphp --}}


                    <tr>
                        <td style="width: 100px;" class="tg-new-0pky">
                            {{ @$item->perfomaInvoice->perfoma_invoice_no_local }}</td>
                        <td class="tg-new-0pky">{{ @$item->perfomaInvoice->po_number }}</td>
                        <td class="tg-new-0pky">{{ @$item->perfomaInvoiceDetail->product->hs_code }}</td>
                        <td class="tg-new-0pky">{{ @$item->perfomaInvoiceDetail->product->name }}</td>
                        <td class="tg-new-0pky">{{ @$item->perfomaInvoiceDetail->size->name }}</td>
                        <td class="tg-new-0pky" style="text-align: right;padding-right:10px">

                            @php

                                if (@$item->perfomaInvoiceDetail->unit == '7') {
                                    $total_quantity = $total_quantity + $item->quantity / 2;
                                    //  echo (int)$item->quantity / 2;
                                } elseif (@$item->perfomaInvoiceDetail->unit == '8') {
                                    $total_quantity = $total_quantity + $item->quantity * 12;
                                    //  echo (int)$item->quantity * 12;
                                } else {
                                    $total_quantity = $total_quantity + $item->quantity;
                                }
                            @endphp

                            {{ @number_format($item->quantity, 0) }}
                        </td>
                        <td class="tg-new-0pky">{{ measurementUnit()[@$item->perfomaInvoiceDetail->unit] }}</td>
                        <td class="tg-new-0pky" style="text-align: right;padding-right:10px">
                            {{ @$item->perfomaInvoiceDetail->article_rate }}</td>
                        <td class="tg-new-0pky" style="text-align: right;padding-right:10px">
                            {{ @number_format($amount, 2) }}</td>
                        {{-- <td class="tg-new-0pky">{{@number_format($net_weight,2)}}</td>
            <td class="tg-new-0pky">{{@number_format($gross_weight,2)}}</td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @if ($data->freight_rate > 0)
                    <tr>
                        <td class="text-center" style="font-weight:bold" colspan="8">Add: Freight charges</td>
                        <td style="text-align: right;padding-right:10px">{{ @$data->freight_rate }}</td>
                    </tr>
                @endif
                @if ($perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate > 0 && $data->freight_rate == null)
                    <tr>
                        <td class="text-center" style="font-weight:bold" colspan="8">Add: Freight charges</td>
                        <td style="text-align: right;padding-right:10px">{{ $perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <td class="tg-new-0pky"></td>
                    <th class="tg-new-0pky" style="text-align: right;padding-right:10px"><span
                            style="font-weight:bold">{{ @number_format($total_quantity) }}</span></th>
                    <td class="tg-new-0pky">PRS</td>
                    <td class="tg-new-0pky"></td>
                    @if ($data->freight_rate > 0)
                        <th class="tg-new-0pky" style="text-align: right;padding-right:10px"><span
                                style="font-weight:bold">{{ @number_format($total_amount + @$data->freight_rate, 2) }}</span>
                        </th>
                    @elseif($perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate > 0 && $data->freight_rate == null)
                        <th class="tg-new-0pky" style="text-align: right;padding-right:10px"><span
                                style="font-weight:bold">{{ @number_format($total_amount + $perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate, 2) }}</span>
                        </th>
                    @else
                        <th class="tg-new-0pky" style="text-align: right;padding-right:10px"><span
                            style="font-weight:bold">{{ @number_format($total_amount, 2) }}</span>
                        </th>
                    @endif
                    {{-- <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($total_net_weight,2)}}</span></td>
                <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($total_gross_weight,2)}}</span></td> --}}
                </tr>
            </tfoot>

        </table>





        <div class="border" style="font-size:12px; padding-left:10px;">
            <p><strong>Amount in Words:</strong>
                {{ currency()[@$data->customer->currency] }} {{ @$data->amount_in_words }} ONLY
                {{-- {{amountInWords($total_amount)}} --}}
                {{-- One Crore only --}}
            </p>
            <p>We Certify that the goods are of Pakistan Origin.</p>
            <p>{{ @$data->customer_specific }}</p>
            <p>{{ @$data->customer->europe_shipment }}</p>

            {{-- <p>{{ @$data-> }}</p> --}}
            {{-- <p class="b-black" style="font-size:12px;"><?= @$data->europe_shipment ?></p> --}}
            {{-- <p class="b-black" style="font-size:12px; padding-left:0px;">We need 2 3 lines of dummy data from lorem ipsum</p> --}}
            {{-- <p class="b-black-for-goods" style="font-size:12px; padding-left:0px;">{{@$data->europe_shipment}}</p> --}}
        </div>
        <div class="b-black border" style="font-size:12px;">
            <p><b style="font-size:12px">BANK DETAILS:</b></p>
            <p style="line-height:0.2px;font-size:12px">Name: {{ @$data->companyDetails->branch_name }}</p>
            <p style="line-height:0.2px;font-size:12px">Address: {{ @$data->companyDetails->branch_address }}</p>
            <p style="line-height:0.2px;font-size:12px">Branch Code : {{ @$data->companyDetails->branch_code }}</p>
            <p style="line-height:0.2px;font-size:12px">Account Name: {{ @$data->companyDetails->account_name }}</p>
            <p style="line-height:0.2px;font-size:12px">Account Number: {{ @$data->companyDetails->account_number }}
            </p>
            <p style="line-height:0.2px;font-size:12px">IBAN Number: {{ @$data->companyDetails->iban_number }}</p>
            <p style="line-height:0.2px;font-size:12px">Swift Code: {{ @$data->companyDetails->swift_code }}</p>
            {{-- <p style="line-height:0.2px;font-size:12px">Name: Bank name</p>
    <p style="line-height:0.2px;font-size:12px">Address: Address here</p>
    <p style="line-height:0.2px;font-size:12px">Branch Code : Code here</p>
    <p style="line-height:0.2px;font-size:12px">Account Name: Account Name</p>
    <p style="line-height:0.2px;font-size:12px">Account Number: Account Number</p>
    <p style="line-height:0.2px;font-size:12px">Iban Number: Iban Number</p>
    <p style="line-height:0.2px;font-size:12px">Swift Code: Swift Code</p> --}}

        </div>
    </div>

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
