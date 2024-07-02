<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
</head>

<body>
    <table>
        <thead>
            <th colspan="9" align="center" style="border: 1px solid #000;"><strong>PACKING LIST</strong></th>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <td colspan="2"><strong>Invoice No:</strong></td>
                <td colspan="2" align="left">{{ @$header_detail['invoice_no'] }}</td>
                <td></td>
                <td colspan="2"><strong>Date1:</strong></td>
                <td colspan="2" align="left">
                    @php
                        $total_quantity = 0;
                        // $date = date_create(now());
                    @endphp
                    {{ date('jS M, Y', strtotime($header_detail['date'])) }}
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2"><strong>Shipped Per:</strong></td>
                <td colspan="2" align="left">{{ @$header_detail['shipped_per'] }}</td>
                {{-- @foreach ($detail_data as $key => $item)
                @php
                if (@$item->perfomaInvoiceDetail->unit == '7')
                {
                  $total_quantity = $total_quantity + ($item->quantity / 2);
                  // echo (int)$item->quantity / 2;
                }
                elseif (@$item->perfomaInvoiceDetail->unit == '8')
                {
                  $total_quantity = $total_quantity + ($item->quantity * 12);
                  // echo (int)$item->quantity * 12;
                }
                else
                {
                  $total_quantity = $total_quantity + $item->quantity;
                }
                @endphp
                @endforeach --}}
                <td></td>
                <td colspan="2"><strong>Total Quantity:</strong></td>
                <td colspan="2" align="left">{{ $header_detail['total_quantity'] }} PRS</td>
            </tr>
            <tr>
                <td colspan="2"> <strong>BL / AWB No:</strong> </td>
                <td colspan="2" align="left"> {{ @$header_detail['awb_no'] }} </td>
                <td></td>
                <td colspan="2"><strong>No. Of Packages:</strong></td>
                <td colspan="2" align="left">{{ $header_detail['carton'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><strong>F.I No:</strong> </td>
                <td colspan="2" align="left"> {{ @$header_detail['form_no'] }} </td>
                <td></td>
                <td colspan="2"><strong>Total Volume:</strong></td>
                <td colspan="2" align="left">{{ $header_detail['cbm'] }} CBM</td>
            </tr>
            <tr>
                <td colspan="2"> <strong>Price Base:</strong></td>
                <td colspan="2" align="left"> {{ $header_detail['price_base'] }}</td>
                <td></td>
                <td colspan="2"> <strong>Payment terms:</strong> </td>
                <td colspan="2" align="left"> {{ @$header_detail['payment_terms'] }} </td>
            </tr>
            <tr></tr>
            <tr>
                <td style="border: 1px solid #000;"><strong>Bill To:</strong></td>
                <td style="border: 1px solid #000;" align="left" colspan="8">{{ @$header_detail['bill_to'] }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"> <strong>Ship to:</strong> </td>
                <td style="border: 1px solid #000;" align="left" colspan="8"> {{ @$header_detail['address'] }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;" colspan="2" rowspan="2"><strong>Description of goods:</strong>
                </td>
                <td style="border: 1px solid #000;" align="left" colspan="7" rowspan="2">
                    {{ $header_detail['description'] }} </td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th style="width: 65px; border: 1px solid #000 !important"><strong>PO#</strong></th>
                <th style="width: 90px; border: 1px solid #000 !important"><strong>ARTICE NO</strong></th>
                <th style="width: 90px; border: 1px solid #000 !important"><strong>SIZE</strong></th>
                <th style="width: 70px; border: 1px solid #000 !important"><strong>QTY</strong></th>
                <th style="width: 30px; border: 1px solid #000 !important"><strong>UOM</strong></th>
                <th style="width: 60px; border: 1px solid #000 !important"><strong>PACK</strong></th>
                <th style="width: 40px; border: 1px solid #000 !important"><strong>CTN</strong></th>
                <th style="width: 50px; border: 1px solid #000 !important"><strong>CBM</strong></th>
                <th style="width: 50px; border: 1px solid #000 !important"><strong>NW/KG</strong></th>
                <th style="width: 50px; border: 1px solid #000 !important"><strong>GW/KG</strong></th>
                <th style="width: 50px; border: 1px solid #000 !important"><strong>CTN SERIAL</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mergedArray as $item)
                <tr class="description_rows">
                    <td class="tg-new-0pky">{{ @$item['po_no'] }}</td>
                    <td class="tg-new-0pky">{{ $item['article_no'] }}</td>
                    <td class="tg-new-0pky">{{ $item['size'] }}</td>
                    <td class="tg-new-0pky">{{ @number_format($item['quantity']) }}</td>
                    <td class="tg-new-0pky">{{ $item['unit_of_measurement'] }}</td>
                    <td class="tg-new-0pky">{{ $item['individual_packing'] }}</td>
                    <td class="tg-new-0pky">{{ $item['carton'] }}</td>
                    <td class="tg-new-0pky">{{ $item['ind_cbm'] }}</td>
                    <td class="tg-new-0pky">{{ $item['net_weight'] }}</td>
                    <td class="tg-new-0pky">{{ $item['gross_weight'] }}</td>
                    <td class="tg-new-0pky">{{ $item['carton_serial'] }}</td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <th class="tg-new-0pky"><span style="font-weight:bold">{{ $footer_detail['total_quantity'] }}</span>
                </th>
                <td class="tg-new-0pky" style="font-weight:bold">PRS</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"><span style="font-weight:bold">{{ $footer_detail['total_carton'] }}</span></td>
                <th class="tg-new-0pky"><span style="font-weight:bold">{{ $footer_detail['total_cbm'] }}</span></th>
                <td class="tg-new-0pky"><span
                        style="font-weight:bold">{{ round($footer_detail['total_net_weight']) }}</span></td>
                <td class="tg-new-0pky"><span
                        style="font-weight:bold">{{ round($footer_detail['total_gross_weight']) }}</span></td>

                <td class="tg-new-0pky"><span
                        style="font-weight:bold">{{ $footer_detail['total_carton_serial'] }}</span></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
