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
*{
    border-collapse:collapse;
}
td{
    text-align:center;
    border: 1px solid black;
    
}
.b{
    background-color:rgb(14, 180, 246);
}
.g{
    background-color:rgb(181, 227, 181);
}
.fat{
    background-color:rgb(208, 208, 208);
    border: 3px solid black;
    font-weight: bold;

}
h3{
    border: 1px solid black;
    display: inline;

}
.yel{
    background-color:yellow;
    color: red;
}
.table-data{
    /* margin-right: 500px; */
}
.bold{
    font-weight: bold;
}
.thick{
    border: 2px solid black;
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
                <h3 class="yel">Orders Shipped</h3><br>
                @if (@$data[0]->title == null)
                <h3 class="b">{{@$data[0]->customer_company_name}}</h3>
                @else
                <h3 class="b">{{@$data[0]->title}}</h3>
                @endif
            </div>
            <table>
                <thead>
                    <tr class="bold thick">
                        <td >Invoice #</td>
                        <td >Order #</td>
                        <td>CUSTOMER PO #</td>
                        <td>SIZE</td>
                        <td>ARTICLE#</td>
                        <td>Quantity.</td>
                        <td>UOM</td>
                        <td>Currency</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_amount = 0;
                        $total_quantity = 0;
                    @endphp
                    @foreach ($data as $item)
                    @php
                        $total_amount += @$item->total;
                        if (@$item->unit == 7)
                            $total_quantity = $total_quantity + ($item->quantity / 2);
                        elseif(@$item->unit == 8)
                            $total_quantity = $total_quantity + ($item->quantity * 12);
                        else
                            $total_quantity = $total_quantity + $item->quantity;
                    @endphp
                    <tr>
                        <td>{{@$item->invoice_no}} </td>
                        <td>{{@$item->perfoma_invoice_no_local}} </td>
                        <td>{{@$item->po_number}}</td>
                        <td>{{@$item->size}}</td>
                        <td>{{@$item->product_name}}</td>
                        <td>{{@$item->quantity}}</td>
                        <td>{{ measurementUnit()[@$item->unit] }}</td>
                        <td>{{currency()[@$item->currency]}}</td>
                        <td>{{@number_format($item->total,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td>{{$total_quantity}}</td>
                        <td>PRS</td>
                        <td colspan="1"></td>
                        <td>{{@number_format($total_amount,2)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>