<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ivoice Custom</title>
    <style>
        table {
            /* border: 1px solid #ddd; */
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        p {
            margin: 5px auto;
        }

        #detail_table {
            width: 700px;
            border-collapse: collapse;
        }

        #detail_table,
        #detail_table th,
        #detail_table tfoot tr td {
            border: 2px solid;
            text-align: center;
        }

        #detail_table td {
            text-align: center;
            border-right: 2px solid;
        }
    </style>
</head>

<body>
    @if ($data[0]->title == 'Fine Grip Import Export')
        <style>
            @page {
                margin-top: 300px;
            }
        </style>
    @else
        <style>
            @page {
                margin-top: 0px;
            }
        </style>
    @endif
    <table style="width: 700px;padding-top: 150px;">
        <tr>
            <td colspan="9">
                <h4
                    style="
                text-align: center;
                text-decoration: underline;
                font-style: italic;
                font-size: 18px;
            ">
                    Custom Invoice
                    {{-- @dd(@$data[0]->shipment_method) --}}
                    {{-- @dd({{strtok(@$data[0]->title, " ")}}) --}}

                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 20px;">
                <p style="font-weight: bold;">
                    Invoice No:
                    <span style="font-weight: bold">{{ $data[0]->invoice }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td style="padding-top: 20px;text-align:right;">
                <p style="font-weight: bold;">Date:
                    <span>{{ date('d/m/Y', strtotime($data[0]->invoice_creation_date)) }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 20px;">
                <p style="font-weight: bold">
                    PI No.:
                    <span style="font-weight: bold">{{ $data[0]->perfoma_invoice_no_local }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td style="padding-top: 20px;text-align:right;">
                <p style="font-weight: bold">Date: <span>{{ date('d/m/Y', strtotime($data[0]->pi_date)) }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="9" style="padding-top: 20px;">
                <p style="font-weight: bold">
                    Invoice for:
                    <span style="font-weight: normal">{{ $data[0]->invoice_for }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 20px;">
                <p style="font-weight: bold">
                    Shipped Per S.S.:
                    <span style="font-weight: 100">{{ $data[0]->shipped_per }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            {{-- <td style="font-weight: bold; padding-top:20px;text-align:right;">
                <p>To: <span>{{$data[0]->ship_to}}</span></p>
            </td> --}}
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 20px;">
                <p style="font-weight: bold">
                    FI No:
                    <span>{{ $data[0]->form_no }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td style="font-weight: bold;padding-top:20px;text-align:right;">
                <p>Date: <span>{{ date('d/m/Y', strtotime($data[0]->form_date)) }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="9" style="padding-top: 20px;">
                <p style="font-weight: bold">
                    For Account of Messers:
                    <span>{{ $data[0]->customer_company_name }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="9" style="padding-top: 20px;padding-bottom:10px;">
                <p>{{ $data[0]->bill_to }}</p>
            </td>
        </tr>
    </table>
    <table id="detail_table" style="padding-top: 35px;">
        <thead>
            <tr>
                <th style="height:25px">
                    <strong>Markd/No</strong>
                </th>
                <th style="height:25px">
                    <strong>Product Description</strong>
                </th>
                <th style="height:25px">
                    <strong>Size</strong>
                </th>
                <th style="height:25px">
                    <strong>Quantity</strong>
                </th>
                <th style="height:25px">
                    <strong>UNIT</strong>
                </th>
                <th style="height:25px">
                    <strong>Price</strong>
                </th>
                <th style="height:25px">
                    <strong>Amount</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">
                    <p style="font-weight: bold"> {{ strtok(@$data[0]->title, ' ') }} 1 TO UP
                        {{ $data[0]->country_name }}</p>
                </td>
                <td>
                    <p style="font-weight: bold; text-align: left; margin-bottom: 0px;padding-left:5px;">
                        {{ $data[0]->perfoma_invoice_no_local }} PO#<span>{{ $data[0]->po_number }}</span>
                    </p>
                </td>
                <td style="padding-top: 20px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p style="font-weight: bold">{{ currency()[$data[0]->currency] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <p>MIX</p>
                </td>
                <td>
                    <p>{{ number_format($data[0]->quantity) }}</p>
                </td>
                <td>
                    <p>PRS</p>
                </td>
                <td>
                    <p>{{ number_format(@$amount[0]->amount / @$data[0]->quantity, 4) }}</p>
                </td>
                <td>
                    <p>{{ number_format(@$amount[0]->amount, 2) }}</p>
                </td>
            </tr>
            <tr>
                <td </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left; padding-top: 100px;padding-left:5px;">
                    CBM: <span>{{ number_format($packing_list_details[0]->cbm, 2) }}</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:5px;">
                    FOB <span>{{ @$data[0]->shipped_per }}</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:5px;">
                    Net Wt: <span>{{ $packing_list_details[0]->net_weight }} KGS</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:5px;">
                    Gross Wt: <span>{{ $packing_list_details[0]->gross_weight }} KGS</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="height:25px">
                    <p style="font-weight: bold">TOTAL</p>
                </td>
                <td style="height:25px"></td>
                <td style="height:25px"></td>
                <td style="height:25px">
                    <p style="font-weight: bold">{{ number_format($data[0]->quantity) }}</p>
                </td>
                <td style="height:25px"></td>
                <td style="height:25px"></td>
                <td style="height:25px">
                    <p style="font-weight: bold">{{ number_format($amount[0]->amount, 2) }}</p>
                </td>
            </tr>
        </tfoot>

    </table>
</body>

</html>
