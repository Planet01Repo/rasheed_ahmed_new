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
    vertical-align: middle !important;
}
.bold{
    font-weight: bold;
}
.thick{
    border: 2px solid black;
}
.custom-align {
        border-color: inherit;
        text-align: right;
        vertical-align: top;
        padding: 5px 5px 3px 10px
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
                <h3 class="yel">Payment Ledger</h3><br>
                {{-- @dd($data[0]->name) --}}
                @if (@$data[0]->name != null)
                    <h3 class="b">{{$data[0]->customer_company_name}}</h3>
                @endif
            </div>
            <table>
                <thead>
                    <tr class="bold thick">
                        <td >Invoice #</td>
                        <td >BOL DATE</td>
                        <td>AMOUNT</td>
                        <td>CURRENCY</td>
                        <td>DUE DATE</td>
                        <td>PAYMENT RECEIVED</td>
                        <td>BALANCE</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum_balance = 0;
                    @endphp
                    @foreach ($data as $item)
                    @php
                        $sum_balance += @$item->balance;
                    @endphp
                    <tr>
                        <td>{{@$item->invoice_no}} </td>
                        <td>{{@$item->awb_date}} </td>
                        <td class="custom-align">{{@number_format($item->amount,2)}}</td>
                        <td>{{currency()[@$item->currency]}}</td>
                        <td>{{@$item->due_date ?? 'N/A'}}</td>
                        <td>{{@$item->payment_received ?? 'N/A'}}</td>
                        <td class="custom-align">{{@$item->balance}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"></td>
                        <td>{{$sum_balance}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>