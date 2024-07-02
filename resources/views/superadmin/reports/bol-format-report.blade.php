<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BL Format</title>
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
            font-weight: bold;
        }

        p {
            margin: 0px auto;
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

        .mb-0 {
            margin-bottom: 0px !important;
        }

        .pt-15 {
            padding-top: 15px !important;
        }
    </style>
</head>

<body>
    <table style="width: 700px;padding-top: 150px;">
        <tr>
            <td style="padding-top: 20px;">
                <p>SHIPPER:</p>
            </td>
            <td style="padding-top: 20px;">
                <p>{{$data[0]->title}}</p>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td style="font-weight: 100;padding-top: 20px;">
                {{$data[0]->company_address}}
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;">
                <p>CONSIGEE:</p>
            </td>
            <td  style="padding-top: 20px;">
                <p>{{$data[0]->branch_name}}</p>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td style="font-weight: 100; padding-bottom: 24px;padding-top: 20px;">
                {{$data[0]->branch_address}}
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;">
                <p>Notify:</p>
            </td>
            <td style="padding-top: 20px;">
                <p>{{$data[0]->customer_company_name}}</p>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td style="font-weight: 100;padding-top: 20px;">{{$data[0]->bill_to}}</td>
        </tr>
        <tr>
            <td style="padding-top: 20px;padding-bottom: 24px;">
                <p>FI No:</p>
            </td>
            <td style="padding-top: 20px;padding-bottom: 24px;">
                <p>{{$data[0]->form_no}} <span>{{$data[0]->form_date}}</span></p>
            </td>
        </tr>
    </table>
    <table id="detail_table" style="width: 500px">
        <thead>
            <tr>
                <th>
                    <strong>Markd/No</strong>
                </th>
                <th>
                    <strong>Product Description</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{strtok(@$data[0]->title, " ")}} 1 TO UP {{$data[0]->country_name}}</td>
                <td>
                    <p style="font-weight: bold">Total Cartons {{$packing_list_details[0]->carton}}</p>
                </td>
                
            </tr>
            <tr>
                <td  style="padding-top:20px"></td>
                <td style="padding-top:20px">
                    <p style="font-weight: bold">LEATHER GLOVES</p>
                </td>
                
            </tr>
            <tr>
                <td style="padding-top:20px"></td>
                <td  style="padding-top:20px">
                    <p style="font-weight: bold">
                        {{$data[0]->perfoma_invoice_no_local}} <span>PO# {{$data[0]->po_number}}</span>
                    </p>
                </td>
                
            </tr>
            <tr>
                <td style="padding-top:20px"></td>
                <td style="padding-top:20px">
                    <p style="font-weight: bold"></p>
                </td>
                
            </tr>
            <tr>
                <td style="padding-top:20px"></td>
                <td style="padding-top:20px">
                    <p style="font-weight: bold"></p>
                </td>
                
            </tr>
            <tr>
                <td style="padding-top:20px"></td>
                <td style="padding-top:20px">
                    <p style="font-weight: bold; text-align: left;padding-left:10px">
                        Invoice No: {{$data[0]->invoice}}
                    </p>
                </td>
                
            </tr>
            {{-- <tr>
                <td style="padding-top:20px"></td>
                <td style="padding-top:20px">
                </td>
                
            </tr> --}}
            <tr>
                <td style="padding-top:20px"></td>
                <td style="padding-top:20px">
                    <p style="font-weight: bold; text-align: left;padding-left:10px">
                        Total Quantity {{number_format($quantity[0]->quantity)}} Pairs
                    </p>
                </td>
            </tr>
            ​
            <tr>
                <td style="padding-top:20px"></td>
                <td style="font-weight: bold; text-align: left; padding-top: 100px;padding-left:10px">
                    CBM: <span>{{number_format($packing_list_details[0]->cbm,2)}}</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:10px">
                    FOB <span>KARACHI BY SEA</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:10px">
                    Net Wt: <span>{{$packing_list_details[0]->net_weight}} KGS</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="font-weight: bold; text-align: left;padding-left:10px">
                    Gross Wt: <span>{{$packing_list_details[0]->gross_weight}} KGS</span>
                </td>
            </tr>
        </tbody>
        {{-- <tfoot>
            <tr>
                <td style="padding: 10px"></td>
                <td style="padding: 10px"></td>
            </tr>
        </tfoot> --}}
    </table>
</body>

</html>
