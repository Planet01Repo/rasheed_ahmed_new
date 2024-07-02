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
            <th colspan="9" align="center" style="border: 1px solid #000;"><strong>COMMERCIAL INVOICE</strong></th>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <td colspan="2"><strong>Invoice No:</strong></td>
                <td colspan="2" align="left">{{ @$data->invoice_no }}</td>
                <td></td>
                <td colspan="2"><strong>Date:</strong></td>
                <td colspan="2" align="left">
                    @php
                        $total_quantity = 0;
                        echo date('jS M, Y', strtotime(@$data->created_at));
                    @endphp
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2"><strong>Shipped Per:</strong></td>
                <td colspan="2" align="left">{{ @$data->shipped_per }}</td>
                @foreach ($detail_data as $key => $item)
                    @php
                        if (@$item->perfomaInvoiceDetail->unit == '7') {
                            $total_quantity = $total_quantity + $item->quantity / 2;
                            // echo (int)$item->quantity / 2;
                        } elseif (@$item->perfomaInvoiceDetail->unit == '8') {
                            $total_quantity = $total_quantity + $item->quantity * 12;
                            // echo (int)$item->quantity * 12;
                        } else {
                            $total_quantity = $total_quantity + $item->quantity;
                        }
                    @endphp
                @endforeach
                <td></td>
                <td colspan="2"><strong>Total Quantity:</strong></td>
                <td colspan="2" align="left">{{ @number_format($total_quantity) }} PRS</td>
            </tr>
            <tr>
                <td colspan="2"> <strong>BL / AWB No:</strong> </td>
                <td colspan="2" align="left"> {{ @$data->awb_no }} </td>
                <td></td>
                <td colspan="2"> <strong>Date:</strong> </td>
                <td colspan="2" align="left">
                    @php
                        $date = date_create(@$data->awb_date);
                        echo date_format($date, 'jS M, Y');
                    @endphp
                </td>
            </tr>

            <tr>

                <td colspan="2"><strong>F.I No:</strong> </td>
                <td colspan="2" align="left"> {{ @$data->form_no }} </td>
                <td></td>
                <td colspan="2"><strong>Date:</strong> </td>
                <td colspan="2" align="left">
                    @php
                        $date = date_create(@$data->form_date);
                        echo date_format($date, 'jS M, Y');
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>No. Of Packages:</strong></td>
                <td colspan="2" align="left">{{ @$total_carton }}</td>
                <td></td>
                {{-- <td colspan="2" ><strong>Total Volume:</strong></td>
                <td colspan="2"  align="left">{{@number_format($total_volume,2)}} CBM</td> --}}
            </tr>
            <tr>
                <td colspan="2"> <strong>Price Base:</strong></td>
                <td colspan="2" align="left"> {{ @$data->customer->price_base }}</td>
                <td></td>
                <td colspan="2"> <strong>Payment terms:</strong> </td>
                <td colspan="2" align="left"> {{ @$data->customer->payment_terms }} </td>
            </tr>
            <tr></tr>
            <tr>
                <td style="border: 1px solid #000;"><strong>Bill To:</strong></td>
                <td style="border: 1px solid #000;" align="left" colspan="8">{{ @$data->customer->bill_to }}</td>
            </tr>
            <tr>
                @if (@$data->ship_to != null)
                    <td style="border: 1px solid #000;"><strong>Ship To:</strong></td>
                    <td style="border: 1px solid #000;" align="left" colspan="8"> {{ @$data->ship_to }} </td>
                @else
                    <td></td>
                @endif

            </tr>
            <tr>
                <td style="border: 1px solid #000;" colspan="2" rowspan="2"><strong>Description of goods:</strong>
                </td>
                <td style="border: 1px solid #000;" align="left" colspan="7" rowspan="2">
                    {{ @$data->description }} </td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>



    <table>
        <thead>
            <tr>
                <th style="width: 65px; border: 1px solid #000 !important"><strong>Our Order</strong></th>
                <th style="width: 90px; border: 1px solid #000 !important"><strong>Customer PO</strong></th>
                <th style="width: 90px; border: 1px solid #000 !important"><strong>H.S Code</strong></th>
                <th style="width: 70px; border: 1px solid #000 !important"><strong>Article No.</strong></th>
                <th style="width: 30px; border: 1px solid #000 !important"><strong>Size</strong></th>
                <th style="width: 60px; border: 1px solid #000 !important"><strong>Quantity</strong></th>
                <th style="width: 40px; border: 1px solid #000 !important"><strong>UOM</strong></th>
                <th style="width: 50px; border: 1px solid #000 !important"><strong>U/Price</strong></th>
                <th style="width: 80px; border: 1px solid #000 !important"><strong>Amount
                        {{ currency()[@$data->customer->currency] }}</strong></th>
            </tr>
        </thead>
        <tbody>
            @php
                $amount = 0.0;
                $total_amount = 0.0;
                $total_quantity = 0;
                // $hscode = @$item->perfomaInvoiceDetail->product->hs_code;
                // $nt_amount = sprintf("%.4f",$hscode,"%.4f");
                // $nt_amount = substr_replace($hscode, "", 10);
                // dd(strval($hscode));
            @endphp
            @foreach ($detail_data as $key => $item)
                @php
                    $amount = @sprintf('%.3f', @$item->quantity) * @sprintf('%.3f', @$item->perfomaInvoiceDetail->article_rate);
                    $total_amount += $amount;
                @endphp
                <tr>
                    <td style="border: 1px solid #000 !important">
                        {{ @$item->perfomaInvoice->perfoma_invoice_no_local }}</td>
                    <td style="border: 1px solid #000 !important">{{ @$item->perfomaInvoice->po_number }}</td>
                    <td style="border: 1px solid #000 !important">
                        {{ strval(@$item->perfomaInvoiceDetail->product->hs_code) }}</td>
                    <td style="border: 1px solid #000 !important">{{ @$item->perfomaInvoiceDetail->product->name }}
                    </td>
                    <td style="border: 1px solid #000 !important">{{ @$item->perfomaInvoiceDetail->size->name }}</td>
                    <td style="border: 1px solid #000 !important" align="right">
                        @php
                            if (@$item->perfomaInvoiceDetail->unit == '7') {
                                $total_quantity = $total_quantity + $item->quantity / 2;
                                // echo (int)$item->quantity / 2;
                            } elseif (@$item->perfomaInvoiceDetail->unit == '8') {
                                $total_quantity = $total_quantity + $item->quantity * 12;
                                // echo (int)$item->quantity * 12;
                            } else {
                                $total_quantity = $total_quantity + $item->quantity;
                            }
                        @endphp
                        {{ @number_format($item->quantity) }}
                    </td>
                    <td style="border: 1px solid #000 !important">
                        {{ measurementUnit()[@$item->perfomaInvoiceDetail->unit] }}</td>
                    <td style="border: 1px solid #000 !important">{{ @$item->perfomaInvoiceDetail->article_rate }}</td>
                    <td style="border: 1px solid #000 !important" align="right">{{ @number_format($amount, 2) }}</td>
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
                    <td style="text-align: right;padding-right:10px">{{$perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate }}</td>
                </tr>
            @endif
            <tr>
                <td style="border: 1px solid #000 !important"></td>
                <td style="border: 1px solid #000 !important"></td>
                <td style="border: 1px solid #000 !important"></td>
                <td style="border: 1px solid #000 !important"></td>
                <td style="border: 1px solid #000 !important"></td>
                <th style="border: 1px solid #000 !important" align="right"> {{ @number_format($total_quantity) }}
                </th>
                <td style="border: 1px solid #000 !important">PRS</td>
                <td style="border: 1px solid #000 !important"></td>
                @if($data->freight_rate > 0)
                    <th style="border: 1px solid #000 !important" align="right"> {{ @number_format($total_amount + @$data->freight_rate, 2) }}
                    </th>
                @elseif($perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate > 0 && $data->freight_rate == null)
                    <th style="border: 1px solid #000 !important" align="right"> {{ @number_format($total_amount + $perfoma_freight_rate->perfomaInvoiceDetail->perfomaInvoice->freight_rate, 2) }}
                    </th>
                @else
                    <th style="border: 1px solid #000 !important" align="right"> {{ @number_format($total_amount, 2) }}
                    </th>
                @endif
            </tr>
        </tfoot>

    </table>

    <div style="border: 1px solid #000 !important">
        <p><strong>Amount in Words:</strong>
            {{ currency()[@$data->customer->currency] }} {{ @$data->amount_in_words }} ONLY
        </p>
        <p>We Certify that the goods are of Pakistan Origin.</p>
        <p class="spacing">{{ @$data->customer_specific }}</p>
        <p class="spacing">{{ @$data->customer->europe_shipment }}</p>
    </div>
    <div>
        <p><b style="font-size:12px;">BANK DETAILS:</b></p>
        <p style="line-height:0.2px;font-size:12px">Name: {{ @$data->customer->companyDetails->branch_name }}</p>
        <p style="line-height:0.2px;font-size:12px">Address: {{ @$data->customer->companyDetails->branch_address }}</p>
        <p style="line-height:0.2px;font-size:12px">Branch Code : {{ @$data->customer->companyDetails->branch_code }}</p>
        <p style="line-height:0.2px;font-size:12px">Account Name: {{ @$data->customer->companyDetails->account_name }}</p>
        <p style="line-height:0.2px;font-size:12px">Account Number: {{ @$data->customer->companyDetails->account_number }}</p>
        <p style="line-height:0.2px;font-size:12px">IBAN Number: {{ @$data->customer->companyDetails->iban_number }}</p>
        <p style="line-height:0.2px;font-size:12px">Swift Code: {{ @$data->customer->companyDetails->swift_code }}</p>
    </div>
</body>

</html>
