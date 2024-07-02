<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Customer;
use App\Exports\PackingListExport;
use App\PackingList;
use App\PackingListDetail;
use App\ProductMaterial;
use App\ProductSize;
use App\Product;
use App\PerfomaInvoice;
use PDF;
use App\Country;
use App\Image;
use App\InvoiceCreation;
use App\InvoiceCreationDetail;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class PackingListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = PackingList::with(['packinglistdetail', 'customer'])->orderBy('id', 'DESC')->get();
        return view('superadmin.packing_list.view')->with(['title' => 'Packing List', 'data' => $data]);
    }
    public function add(Request $request)
    {
        $data = "";
        if (isset($request->id)) {
            $data = PackingList::where('id', $request->id)->first();
            $detail_data = PackingListDetail::where('packing_list_id', $request->id)->get();
        } else {
            $detail_data = "";
        }

        $product_data = Product::with(['productsize.size', 'images', 'productmaterial.material'])->where('customer_id', NULL)->get();
        $customer =  Customer::with(['company', 'country'])->get();
        // dd($customer);
        return view('superadmin.packing_list.add')->with(['title' => 'Packing List', 'data' => $data, 'detail_data' => $detail_data, "product_data" => $product_data, "customer" => $customer, "ckeditor" => "yes"]);
    }

    public function post(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'invoice_no' => 'required',
            // 'shipping_method' => 'required',
            'customer_id' => 'required',
        ]);
        if (isset($request->id) && !empty($request->id)) {
            if (PackingList::where('invoice_no', $request->invoice_no)->where('id', '!=', $request->id)->count() > 0) {
                return ["error" => "Invoice No is alredy in used."];
            }
            $data = PackingList::where('id', $request->id)->update([
                // 'local_invoice_no' => @$request->local_invoice_no,
                // 'description' => @$request->description,
                // 'europe_shipment' => @$request->europe_shipment,
                // 'customer_specific' => @$request->customer_specific,
                'invoice_no' => @$request->invoice_no,
                'customer_id' => @$request->customer_id,
                'awb_no' => @$request->awb_no,
                'awb_date' => @$request->awb_date,
                'form_no' => @$request->form_no,
                'form_date' => @$request->form_date,
                // 'packing_list_date' => @$request->packing_list_date,
                // 'shipping_method' => @$request->shipping_method,
                'shipped_per' => @$request->shipped_per,
                'updated_by' => Auth::user()->id,
            ]);

            PackingListDetail::where('packing_list_id', $request->id)->delete();
            if (isset($request->product_id)) {
                $product_id = $request->product_id;
                for ($k = 0; $k < sizeof($product_id); $k++) {
                    $detail_data = new PackingListDetail();
                    $detail_data->packing_list_id = $request->id;
                    $detail_data->product_id = $request->product_id[$k];
                    $detail_data->size_id = $request->size_id[$k];
                    $detail_data->quantity = $request->quantity[$k];
                    $detail_data->cbm = $request->cbm[$k];
                    $detail_data->carton = $request->carton[$k];
                    $detail_data->pack = $request->pack[$k];
                    $detail_data->net_weight = $request->net_weight[$k];
                    $detail_data->gross_weight = $request->gross_weight[$k];
                    $detail_data->save();
                }
            }
        } else {
            if (PackingList::where('invoice_no', $request->invoice_no)->count() > 0) {
                return ["error" => "Invoice No is alredy in used."];
            }


            DB::transaction(function () use ($request) {

                $data = new PackingList();
                // $data->local_invoice_no = $request->local_invoice_no;
                // $data->description = $request->description;
                // $data->europe_shipment = $request->europe_shipment;
                // $data->customer_specific = $request->customer_specific;
                $data->invoice_no = $request->invoice_no;
                $data->customer_id = @$request->customer_id;
                $data->awb_no = @$request->awb_no;
                $data->awb_date = @$request->awb_date;
                // $data->shipping_method = @$request->shipping_method;
                $data->shipped_per = @$request->shipped_per;
                $data->form_no = @$request->form_no;
                $data->form_date = @$request->form_date;
                $data->created_by = Auth::user()->id;
                $data->invoice_creation_id = $request->invoice_creation_id;
                if ($request->packing_list_date != '') {
                    $data->packing_list_date = @$request->packing_list_date;
                }

                $data->save();

                if (isset($request->product_id)) {
                    $product_id = $request->product_id;
                    for ($k = 0; $k < sizeof($product_id); $k++) {
                        $detail_data = new PackingListDetail();
                        $detail_data->packing_list_id = $data->id;
                        $detail_data->product_id = $request->product_id[$k];
                        $detail_data->size_id = $request->size_id[$k];
                        $detail_data->quantity = $request->quantity[$k];
                        $detail_data->cbm = $request->cbm[$k];
                        $detail_data->carton = $request->carton[$k];
                        $detail_data->pack = $request->pack[$k];
                        $detail_data->net_weight = $request->net_weight[$k];
                        $detail_data->gross_weight = $request->gross_weight[$k];
                        $detail_data->save();
                    }
                }
            }, 3);
        }
        // return ["success" => "Successfully Added.", "redirect" => route('packing_list.view')];
        return redirect()->route('packing_list.view')->with("success", "Successfully Created.");
    }
    public function detail(Request $request)
    {
        $data = PackingList::with(['packinglistdetail.product', 'packinglistdetail.size', 'customer'])->where('id', $request->id)->first();
        // dd($data);
        return view('superadmin.packing_list.detail')->with(['title' => 'Packing List Detail', 'data' => $data]);
    }

    public function pdf_report(Request $request, $id)
    {

        try {

            if (ob_get_contents()) ob_end_clean();
            if (isset($request->id)) {
                $countries = Country::get();

                $data = PackingList::with(['customer', 'invoiceCreation'])->where('id', $request->id)->first();
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


                foreach ($invoice_creation_detail as $val) {
                    $po[] = [
                        'po_no' => $val->perfomaInvoice->po_number
                    ];
                }
                foreach ($data->packinglistdetail as $key => $value) {



                    $table_detail[] = [

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
                        } elseif (@$item->product->unit == '8') {
                            $sum_quantity = $sum_quantity + ($value->quantity * 12);
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
                }
                $mergedArray = [];
                for ($i = 0; $i < count($po); $i++) {
                    $mergedArray[] = array_merge($po[$i], $table_detail[$i]);
                }

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
                    } elseif (@$item->perfomaInvoiceDetail->product->unit == '8') {
                        $total_quantity = $total_quantity + ($item->quantity * 12);
                    } else {
                        $total_quantity = $total_quantity + $item->quantity;
                    }
                }

                $header_detail['total_quantity'] = @$total_quantity;

                $footer_detail = [];
                $footer_detail['total_quantity']        =  number_format($total_quantity);
                $footer_detail['total_carton']          =  number_format($sum_carton);
                $footer_detail['total_cbm']             =  number_format($sum_cbm, 3);
                $footer_detail['total_net_weight']      =  number_format(round($sum_net_weight));
                $footer_detail['total_gross_weight']    =  number_format(round($sum_gross_weight));
                $footer_detail['total_carton_serial']   =  number_format($sum_carton);

                $po_data = null;


                $total_carton = 0.0;
                $total_volume = 0.0;

                $pdf = PDF::loadview('superadmin.packing_list.pdf_report', ['data' => $data, 'header_detail' => $header_detail, "countries" => $countries, "total_carton" => $total_carton, "total_volume" => $total_volume, "mergedArray" => $mergedArray, "footer_detail" => $footer_detail]);
                return $pdf->stream('pdf_report.pdf');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function customer_product(Request $request)
    {
        $data['data'] = Product::with(['productsize.size', 'images', 'productmaterial.material'])->where('customer_id', $request->customer_id)->get();
        return json_encode($data);
    }

    public function delete(Request $request)
    {
        PackingList::where('id', $request->id)->delete();
        PackingListDetail::where('packing_list_id', $request->id)->delete();

        return ["success" => "Successfully Deleted.", "redirect" => route('packing_list.view')];
    }

    public function getInvoiceCreationByCustomerId(Request $request)
    {
        try {
            $packing_list = PackingList::where('customer_id', $request->customer_id)->get();

            $packing_list_id = [];
            foreach ($packing_list as $key => $value) {
                if ($value->invoice_creation_id != null) {
                    $packing_list_id[] = $value->invoice_creation_id;
                }
            }
            $object = InvoiceCreation::where('customer_id', $request->customer_id)->get();
            $temp_object = $object->whereNotIn('id', $packing_list_id);
            $data = $temp_object->all();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'There is some issue.',
                'data' => null,
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Record is successfully fetched',
            'data' => $data,
        ]);
    }

    public function getInvoiceCreationDetailsByInvoiceCreationId(Request $request)
    {
        // dd($request->all());
        try {
            $data = InvoiceCreation::find($request->id);
            $measure = measurementUnit();
            $details = $data->invoiceCreationDetail;

            $table_row = '';
            foreach ($details as $key => $value) {
                $table_row .= '<tr class="txtMult">';
                $table_row .= '<input type="hidden" name="product_id[]" value="' . @$value->perfomaInvoiceDetail->product_id . '" />';
                $table_row .= '<input type="hidden" name="size_id[]" value="' . @$value->perfomaInvoiceDetail->size_id . '" />';
                $table_row .= '<input type="hidden" class="unit_of_measurement" name="unit_of_measurement[]" value="' . @$value->perfomaInvoiceDetail->product->unit . '" />';

                $table_row .= '<td class="text-center"> <input type="text" value="' . @$value->perfomaInvoiceDetail->product->name . '" readonly />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" value="' . @$value->perfomaInvoiceDetail->size->name . '" readonly />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" class="quantity" name="quantity[]" value="' . @$value->quantity . '" readonly />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" name="pack[]" value="' . @$value->perfomaInvoiceDetail->product->individual_packing . '" readonly />  </td>';

                //Carton Calculation formula = Quantity Input / Carton Packing inputted in product data
                $ctn = @$value->quantity / @$value->perfomaInvoiceDetail->product->individual_packing;

                //CBM Calaculation Formula = Total Ctn calculated from above formula * CBM inputted in product data
                $temp_product_detail = @$value->perfomaInvoiceDetail->product->productsize;
                $temp_product_size = $temp_product_detail->where('size_id', $value->perfomaInvoiceDetail->size_id)->first();
                // dd($temp_product_size);
                // dd($value->perfomaInvoiceDetail->size_id);
                $cbm = $ctn * @$temp_product_size->cbm;

                // $table_row .= '<td class="text-center"> <input type="text" value="'.@$value->perfomaInvoiceDetail->carton.'" readonly />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" class="carton" name="carton[]" value="' . @$ctn . '" readonly />  </td>';
                // $table_row .= '<td class="text-center"> <input type="text" value="'.@$value->perfomaInvoiceDetail->product->cbm.'" readonly />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" class="cbm" name="cbm[]" value="' . @$cbm . '" />  </td>';
                // $net_weight = $ctn * @$value->perfomaInvoiceDetail->product->net_weight_per_carton;
                // $gross_weight = $ctn * @$value->perfomaInvoiceDetail->product->gross_weight_per_carton;
                @$net_weight = $ctn * @$temp_product_size->net_weight_per_carton;
                @$gross_weight = $ctn * @$temp_product_size->gross_weight_per_carton;
                // dd($gross_weight);
                $table_row .= '<td class="text-center"> <input type="text" class="net_weight" name="net_weight[]" value="' . @$net_weight . '" />  </td>';
                $table_row .= '<td class="text-center"> <input type="text" class="gross_weight" name="gross_weight[]" value="' . @$gross_weight . '" />  </td>';
                $table_row .= '</tr>';
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'status' => false,
                'msg' => 'There is some issue.',
                'data' => null,
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Record is successfully fetched',
            'data' => @$data,
            'details' => @$details,
            'table_row' => @$table_row,
        ]);
    }

    public function exportExcel($id)
    {
        return Excel::download(new PackingListExport($id), 'invoices.xlsx');
    }
}
