<?php

namespace App\Exports;

use App\Country;
use App\InvoiceCreation;
use App\InvoiceCreationDetail;
use App\PackingList;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PackingListExport implements FromView
{
    private $id;
    public function __construct($id)
    {
        $this->id       = $id;
    }
    public function view(): View
    {
        $id = $this->id;
        if (ob_get_contents()) ob_end_clean();
        if (isset($id)) {
            $countries = Country::get();

            $data = PackingList::with(['customer', 'invoiceCreation'])->where('id', $id)->first();
            // dd($data->packinglistdetail->product);
            $invoice_creation = InvoiceCreation::find($data->invoice_creation_id);
            $invoice_creation_detail = InvoiceCreationDetail::with(['perfomaInvoice', 'perfomaInvoiceDetail'])->where('invoice_creation_id', $invoice_creation->id)->get();

            $carton_count = 0;
            $sum_carton = 0;
            $sum_quantity = 0;
            $sum_cbm = 0;
            $sum_net_weight = 0;
            $sum_gross_weight = 0;
            $table_detail = [];
            $po = [];

            // $invoice_creation_detail = $invoice_creation_detail->sortBy('article_no');


            foreach ($invoice_creation_detail as $val) {
                // dd($val->perfomaInvoice->po_number);
                $po[] = [
                    'po_no' => $val->perfomaInvoice->po_number
                ];
            }
            foreach ($data->packinglistdetail as $key => $value) {



                $table_detail[] = [

                    // 'po_no' =>  $po,
                    // 'po_no'                  =>  @$value->packingList->invoiceCreation->invoiceCreationDetail->perfomaInvoice->po_number,
                    'article_no'             =>  @$value->product->name,
                    'size'                   =>  @$value->size->name,
                    'quantity'               =>  @$value->quantity,
                    'unit_of_measurement'    =>  @measurementUnit()[@$value->product->unit],
                    'individual_packing'     =>  @number_format($value->pack),
                    'carton'                 =>  @$value->carton,
                    'ind_cbm'                =>  @number_format($value->cbm, 3),
                    'net_weight'             =>  @number_format($value->net_weight, 2),
                    'gross_weight'           =>  @number_format($value->gross_weight, 2),
                    'carton_serial'          =>  sprintf("%03d", ($carton_count + 1)) . " - " . sprintf("%03d", ($carton_count + $value->carton))
                ];

                foreach ($data->packinglistdetail as $item) {
                    if (@$item->product->unit == '7') {
                        $sum_quantity = $sum_quantity + ($value->quantity / 2);
                        //  echo (int)$value->quantity / 2;
                    } elseif (@$item->product->unit == '8') {
                        $sum_quantity = $sum_quantity + ($value->quantity * 12);
                        //  echo (int)$value->quantity * 12;
                    } else {
                        $sum_quantity = $sum_quantity + $value->quantity;
                    }
                }
                $carton_count += $value->carton;
                $sum_carton += $value->carton;
                $sum_quantity1 = @$sum_quantity;
                $sum_cbm += $value->cbm;
                $sum_net_weight += $value->net_weight;
                $sum_gross_weight += $value->gross_weight;
                // $sum_net_weight += $net_weight;
                // $sum_gross_weight += $gross_weight;
                // $sum_cbm += $cbm;
            }
            $mergedArray = [];
            for ($i = 0; $i < count($po); $i++) {
                $mergedArray[] = array_merge($po[$i], $table_detail[$i]);
            }
            // dd($mergedArray);


            // $date = date_create(now());
            $header_detail = [];
            $header_detail['date']              = @$data->packing_list_date;
            $header_detail['invoice_no']        = @$invoice_creation->invoice_no;
            $header_detail['shipped_per']       = @$data->shipped_per;
            $header_detail['awb_no']            = @$data->awb_no;
            $header_detail['awb_date']          = @date_format(date_create($data->awb_date), "jS M, Y");
            $header_detail['form_no']           = @$data->form_no;
            $header_detail['form_date']         = @date_format(date_create($data->form_date), "jS M, Y");
            $header_detail['carton']            = @number_format($sum_carton);
            $header_detail['cbm']               = @number_format($sum_cbm, 3);
            $header_detail['price_base']        = @$data->customer->price_base;
            $header_detail['payment_terms']     = @$data->customer->payment_terms;
            $header_detail['bill_to']           = @$data->customer->bill_to;
            $header_detail['address']           = @$data->invoiceCreation->ship_to;
            $header_detail['description']       = @$data->invoiceCreation->description;

            $total_quantity = 0;
            foreach ($data->invoiceCreation->invoiceCreationDetail as $item) {
                if (@$item->perfomaInvoiceDetail->product->unit == '7') {
                    $total_quantity = $total_quantity + ($item->quantity / 2);
                    //  echo (int)$item->quantity / 2;
                } elseif (@$item->perfomaInvoiceDetail->product->unit == '8') {
                    $total_quantity = $total_quantity + ($item->quantity * 12);
                    //  echo (int)$item->quantity * 12;
                } else {
                    $total_quantity = $total_quantity + $item->quantity;
                }
            }

            $header_detail['total_quantity'] = @$total_quantity;
            // dd($sum_carton);
            // array_multisort($table_detail);
            // dd($table_detail);
            // foreach($data->packinglistdetail as $key => $value)
            // {
            //     $table_detail[] = [

            //         'po_no'                  =>  @$invoice_creation_detail[$key]->perfomaInvoice->po_number,
            //         'article_no'             =>  @$value->product->name,
            //         'size'                   =>  @$value->size->name,
            //         'quantity'               =>  @$value->quantity,
            //         'unit_of_measurement'    =>  @measurementUnit()[@$value->product->unit],
            //         'individual_packing'     =>  @number_format($value->product->individual_packing),
            //         'carton'                 =>  @$value->carton,
            //         'ind_cbm'                =>  @number_format($value->cbm,2),
            //         'net_weight'             =>  @number_format($value->net_weight,2),
            //         'gross_weight'           =>  @number_format($value->gross_weight,2),
            //         'carton_serial'          =>  sprintf("%03d",($carton_count + 1))." - ". sprintf("%03d",($carton_count + $item->carton)),
            //     ];
            // }
            // dd($table_detail);

            $footer_detail = [];
            $footer_detail['total_quantity']        =  @number_format($total_quantity);
            $footer_detail['total_carton']          =  @number_format($sum_carton);
            $footer_detail['total_cbm']             =  @number_format($sum_cbm, 3);
            $footer_detail['total_net_weight']      =  @round($sum_net_weight);
            $footer_detail['total_gross_weight']    =  @round($sum_gross_weight);
            $footer_detail['total_carton_serial']   =  @number_format($sum_carton);

            // dd($table_detail);
            // dd($footer_detail);
            // dd($header_detail);
            // dd($data->invoice_creation_id);
            // dd($data->invoiceCreation->invoiceCreationDetail[1]->perfomaInvoice);

            // po_number
            // $detail_data = PackingListDetail::with(['product','size'])->where('packing_list_id', $request->id)->orderBy('product_id', 'DESC')->get();
            // dd($detail_data);
            // $po_data = InvoiceCreationDetail::with(['perfomaInvoice', 'perfomaInvoiceDetail'])->where('perfoma_invoice_id', $request->id)->orderBy('perfoma_invoice_id', 'DESC')->get();
            // dd($po_data->perfomaInvoice);
            $po_data = null;
            // dd($detail_data);


            $total_carton = 0.0;
            $total_volume = 0.0;
            // foreach ($detail_data as $key => $value)
            // {
            //     $total_carton += $value->carton;
            //     $total_volume += $value->cbm;
            // }

            // foreach ($data->invoiceCreation->invoiceCreationDetail as $key => $value)
            // {

            // }
            return view('superadmin.packing_list.test_excel', ['data' => $data, 'header_detail' => $header_detail, "countries" => $countries, "total_carton" => $total_carton, "total_volume" => $total_volume, "mergedArray" => $mergedArray, "footer_detail" => $footer_detail]);
        }
    }
}