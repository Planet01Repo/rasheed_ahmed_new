<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            font-size: 13px
        }
        .custom-alignment {
        border-color: inherit;
        text-align: right;
        vertical-align: top;
        padding: 5px 5px 3px 10px
    }
    </style>
</head>
<body>
    <h3>({{@$data[0]->customer_company_name}}) Shipment Plan</h3>
    @php
        $quantityTotal = 0;
        $cbm_total = 0;
        $carton_total = 0;
    @endphp
    <table width="100%" cellpadding="5" border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Cust.PO #</th>
                <th>Size</th>
                <th>Article #</th>
                <th>Qty</th>
                <th>UOM</th>
                <th>QTY in pairs</th>
                <th>Pack</th>
                <th>CTN</th>
                <th>CBM</th>
                <th>TTL CBM</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
                $total_quantity = 0;
                $quantity_pairs = 0;
            @endphp
            @foreach ($data as $item)
            @php
                if (@$item->unit == 7)
                    $total_quantity = $total_quantity + ($quantities[$item->id] / 2);
                elseif (@$item->unit == 8)
                    $total_quantity = $total_quantity + ($quantities[$item->id] * 12);
                else
                    $total_quantity = $total_quantity + $quantities[$item->id];
            @endphp
            @php
                if (@$item->unit == 7)
                    $quantity_pairs = ($quantities[$item->id] / 2);
                elseif (@$item->unit == 8)
                    $quantity_pairs = ($quantities[$item->id] * 12);
                else
                    $quantity_pairs = $quantities[$item->id];
            @endphp
            @php
                $carton = @$quantity_pairs / number_format($item->pack);
            @endphp
                <tr>
                    <td>{{$item->perfoma_invoice_no_local}}</td>
                    <td>{{$item->po_number}}</td>
                    <td>{{$item->size_name}}</td>
                    <td>{{$item->product_name}}</td>
                    <td class="custom-alignment">{{$quantities[$item->id]}}</td>
                    <td>{{ measurementUnit()[@$item->unit] }}</td>
                    <td class="custom-alignment">{{@$quantity_pairs}}</td>
                    <td class="custom-alignment">{{number_format($item->pack)}}</td>
                    <td class="custom-alignment">{{@$carton}}</td>
                    <td class="custom-alignment">{{$item->cbm}}</td>
                    <td class="custom-alignment">{{$carton * $item->cbm}}</td>
                </tr>
                @php
                    $quantityTotal += $quantities[$item->id];
                    $cbm_total += $carton * $item->cbm;
                    $carton_total += $carton;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th class="custom-alignment">{{$total_quantity}}</th>
                <td>PRS</td>
                <td></td>
                <td></td>
                <th class="custom-alignment">{{$carton_total}}</th>
                <td></td>
                <th class="custom-alignment">{{$cbm_total}}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>