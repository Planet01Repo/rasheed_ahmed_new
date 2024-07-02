<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Invoice</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td colspan="2" style="border: 1px solid #000; background:yellow;"><strong> NEW ORDER REPORT</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid #000; background:lightblue;"><strong>
                        @if (@$data[0]->title == null)
                            {{ @$data[0]->customer_company_name }}
                        @else
                            {{ @$data[0]->title }}
                        @endif
                    </strong></td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr class="bold thick">
                <td colspan="2" style="border: 1PX solid #000; background:lightgray;"><strong> ORDER #</strong></td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>CUSTOMER PO #</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>DATED</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>CUSTOMER NAME</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>CUSTOMER CODE</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>ACCEPTED DATE</strong> </td>
                <td colspan="3" style="border: 1PX solid #000; background:lightgray;"><strong> DESCRIPTION OF
                        GOODS</strong></td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>SIZE</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>ARTICLE#</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>ORDER QTY.</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>UOM</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>PACK CTN</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong># OF CTNS</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>UNIT PRICE</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>CURRENCY</strong> </td>
                <td colspan="2" style="border: 1PX solid #000; background:lightgray;"><strong>TOTAL PRICE</strong>
                </td>
                <td colspan="2" style="border: 1PX solid #000; background:lightgray;"><strong>PROCESSED AT</strong>
                </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>CBM CTN</strong> </td>
                <td style="border: 1PX solid #000; background:lightgray;"><strong>TOTAL CBM</strong> </td>
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
                    <td colspan="2" style="border: 1px solid #000;">{{ @$item->perfoma_invoice_no_local }} </td>
                    <td style="border: 1px solid #000;">{{ @$item->po_number }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->pi_date }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->customer_company_name }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->customer_code }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->accepted_date }}</td>
                    <td colspan="3" style="border: 1px solid #000;"> </td>
                    <td style="border: 1px solid #000;">{{ @$item->size_name }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->product_name }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->quantity }}</td>
                    <td style="border: 1px solid #000;">{{ measurementUnit()[@$item->unit] }}</td>
                    <td style="border: 1px solid #000;">{{ number_format(@$item->no_of_carton) }}</td>
                    <td style="border: 1px solid #000;">{{ @$item->carton }} </td>
                    <td style="border: 1px solid #000;">{{ @$item->article_rate }}</td>
                    <td style="border: 1px solid #000;">{{ currency()[@$item->currency] }}</td>
                    <td colspan="2" style="border: 1px solid #000;">{{ number_format(@$item->total_price, 2) }}</td>
                    <td colspan="2" style="border: 1px solid #000;">{{ cities()[@$item->processed_at] ?? 'N/A' }}
                    </td>
                    <td style="border: 1px solid #000;">{{ number_format(@$item->cbm, 3) }}</td>
                    <td style="border: 1px solid #000;">{{ number_format(@$item->carton * @$item->cbm, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border: 1px solid #000;" colspan="2" class=" bold thick">
                    <strong>{{ number_format(@$total_price, 2) }}</strong>
                </td>
                <td colspan="2"></td>
                <td></td>
                <td style="border: 1px solid #000;" class=" bold thick">
                    <strong>{{ number_format(@$total_cbm, 2) }}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
