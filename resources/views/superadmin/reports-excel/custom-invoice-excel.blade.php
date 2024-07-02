<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Custom</title>
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
            width: 800px;
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
    <table style="width: 800px">
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
            <td colspan="2">
                <p style="font-weight: bold">
                    Invoice No:
                    <span style="font-weight: bold">{{ $data[0]->invoice }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td>
                <p style="font-weight: bold">Date: <span>{{ $data[0]->invoice_creation_date }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="font-weight: bold">
                    PI No.:
                    <span style="font-weight: bold">{{ $data[0]->perfoma_invoice_no_local }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td>
                <p style="font-weight: bold">Date: <span>{{ $data[0]->pi_date }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <p style="font-weight: bold">
                    Invoice for:
                    <span style="font-weight: 100">{{ $data[0]->invoice_for }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="font-weight: bold">
                    Shipped Per S.S.:
                    <span style="font-weight: 100">{{ $data[0]->shipped_per }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td style="font-weight: bold">
                <p>To: <span>{{ $data[0]->ship_to }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="font-weight: bold">
                    FI No:
                    <span>{{ $data[0]->form_no }}</span>
                </p>
            </td>
            <td colspan="6"></td>
            <td style="font-weight: bold">
                <p>Date: <span>{{ $data[0]->form_date }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <p style="font-weight: bold">
                    For Account of Messers:
                    <span>{{ $data[0]->title }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <p>{{ $data[0]->address }}</p>
            </td>
        </tr>
    </table>
    <table id="detail_table">
        <thead>
            <tr>
                <th>
                    <strong>Markd/No</strong>
                </th>
                <th>
                    <strong>Product Description</strong>
                </th>
                <th>
                    <strong>Size</strong>
                </th>
                <th>
                    <strong>Quantity</strong>
                </th>
                <th>
                    <strong>UNIT</strong>
                </th>
                <th>
                    <strong>Price</strong>
                </th>
                <th>
                    <strong>Amount</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">
                    <p style="font-weight: bold"> {{ strtok(@$data[0]->title, ' ') }} 1 TO UP USA</p>
                </td>
                <td>
                    <p style="font-weight: bold; text-align: left; margin-bottom: 0px">
                        {{ $data[0]->perfoma_invoice_no_local }} PO#<span>{{ $data[0]->po_number }}</span>
                    </p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p style="font-weight: bold">{{ currency()[$data[0]->currency] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>MIX</p>
                </td>
                <td>
                    <p>{{ $data[0]->quantity }}</p>
                </td>
                <td style="background-color: rgba(255, 28, 28, 0.288)">
                    <p style="color: rgb(185, 5, 5)">PRS</p>
                </td>
                <td>
                    <p>{{ $data[0]->article_rate }}</p>
                </td>
                <td>
                    <p>{{ $data[0]->amount }}</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left; padding-top: 100px">
                    CBM: <span>{{ $data[0]->cbm }}</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left">
                    FOB <span>BY SEA</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left">
                    Net Wt: <span>{{ $data[0]->net_weight_per_carton }} KGS</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left">
                    Gross Wt: <span>{{ $data[0]->gross_weight_per_carton }} KGS</span>
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
                <td>
                    <p style="font-weight: bold">TOTAL</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p style="font-weight: bold">{{ $data[0]->quantity }}</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p style="font-weight: bold">{{ $data[0]->amount }}</p>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
