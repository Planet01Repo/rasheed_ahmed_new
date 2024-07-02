<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Customer;
use App\PerfomaInvoice;
use App\PerfomaInvoiceDetail;
use App\ProductMaterial;
use App\ProductSize;
use App\Product;
use PDF;
use App\Country;
use App\Image;
use App\Company;
use App\CompanyDetail;
use App\InvoiceCreation;
use App\InvoiceCreationDetail;
use App\PackingListDetail;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoiceCreationExport;

class InvoiceCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = null;
        $data = InvoiceCreation::orderBy('id', 'desc')->get();
        // $data = $data->sortByDesc('id');
        // dd($data);
        $title = 'Invoice Creation';
        // $data = PerfomaInvoice::with(['perfomainvoicedetail','customer'])->orderBy('id', 'DESC')->get();
        return view('superadmin.invoice_creation.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;
        $title = 'Invoice Creation';
        // $data = PerfomaInvoice::with(['perfomainvoicedetail','customer'])->orderBy('id', 'DESC')->get();
        // $product_data = Product::with(['productsize.size','images', 'productmaterial.material'])->where('customer_id', NULL)->get(); 
        $customer =  Customer::with(['company', 'country'])->get();
        $_COOKIE['total'] = 1;
        return view('superadmin.invoice_creation.create', compact('title', 'data', 'customer'));
    }

    public function inwords(Request $request)
    {
        $num = $request->numVal;
        return numberTowords(strval($num));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'customer_id'           => 'required',
            // 'company_detail_id'           => 'required',
            'shipped_per'           => 'required',
            'awb_no'                => 'nullable',
            'form_no'               => 'nullable',

            'amount_in_words'       => 'required',
            'description'           => 'required',

            'perfoma_invoice_detail_id.*' => 'required',
            'quantity.*'            => 'required',
        ]);

        try {

            DB::transaction(function () use ($request) {
                $customer = Customer::where('id',$request->customer_id)->first();
                // dd($request->customer_id);
                // $invoice = $this->getInvoiceCreationNoByCompanyInvoicePrefix($request->company_id);
                $invoice = $this->getInvoiceCreationNoByCompanyInvoicePrefix($request->company_id);
                $attributes = [
                    'customer_id'               =>  $request->customer_id,
                    'company_detail_id'         =>  $customer->companyDetails->id,
                    'invoice_no'                =>  $invoice,
                    'invoice_creation_date'     =>  date("Y-m-d"),
                    'shipped_per'               =>  $request->shipped_per,
                    'awb_no'                    =>  $request->awb_no,
                    'form_no'                   =>  $request->form_no,
                    'quantity'                  =>  $request->total_quantity,
                    // 'no_of_package'             =>  $request->no_of_packages,
                    // 'volume'                    =>  $request->volume,
                    'amount_in_words'           =>  $request->amount_in_words,
                    'description'               =>  $request->description,
                    // 'europe_shipment'           => $request->europe_shipment,
                    'customer_specific'         =>  $request->customer_specific,
                    'freight_rate'              =>  $request->freight_rate,
                    // 'quantity'                  =>  $request->quantity,
                ];
                if ($request->ship_to != '' || $request->ship_to != null) {
                    $attributes['ship_to'] = implode(",", $request->ship_to);
                }

                if ($request->payment_date != '') {
                    $attributes['payment_date'] = $request->payment_date;
                }
                if ($request->awb_date != '') {
                    $attributes['awb_date'] = $request->awb_date;
                }
                if ($request->form_date != '') {
                    $attributes['form_date'] = $request->form_date;
                }

                // foreach (json_decode($request->ship_to) as $key1 => $value){
                //     $ship_to[] = $value->value;
                // }
                // $attributes['ship_to'] = implode(", ",$ship_to);
                // dd($attributes);
                $object = InvoiceCreation::create($attributes);

                // dd($object);


                foreach ($request->perfoma_invoice_detail_id as $key => $value) {
                    $detail_attributes = [
                        'invoice_creation_id'        => @$object->id,
                        'perfoma_invoice_id'         => @$request->perfoma_invoice_id[$key],
                        'perfoma_invoice_detail_id'  => @$value,
                        'quantity'                   => @$request->quantity[$key],
                        // 'quantity'                   => $request->quantity, 
                    ];
                    // dd($detail_attributes);

                    $object_detail = InvoiceCreationDetail::create($detail_attributes);

                    // dd($object_detail);
                    // dd($detail_attributes);


                }
                // dd($object_detail);

            });
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('error', 'Some thing is wrong!');
        }
        return redirect()->route('invoice_creation.index')->with('success', 'Data is Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::get();
        $data = InvoiceCreation::find($id);
        $detail_data = InvoiceCreationDetail::where('invoice_creation_id', $id)->get();
        // dd($data);
        $ab = explode(',', $data->ship_to);
        // dd($ab);
        $title = 'Invoice Creation';
        $customer =  Customer::with(['company', 'country'])->get();

        // dd($data->customer_id);
        $perfomaInvoice = PerfomaInvoice::where([['customer_id', '=', $data->customer_id], ['status', '=', 0]])->get();
        // dd($perfomaInvoice);
        // dd($detail_data); perfoma_invoice_no_local
        return view('superadmin.invoice_creation.edit', compact('data', 'detail_data', 'title', 'customer', 'perfomaInvoice', 'ab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            DB::transaction(function () use ($request, $id) {
                // $invoice = $this->getInvoiceCreationNoByCompanyInvoicePrefix($request->company_id);
                $attributes = [
                    'customer_id'               =>  $request->customer_id,
                    // 'company_detail_id'         =>  $request->company_detail_id,
                    // 'invoice_no'                =>  $invoice,
                    // 'invoice_creation_date'     =>  date("Y-m-d"),
                    'shipped_per'               =>  $request->shipped_per,
                    'awb_no'                    =>  $request->awb_no,
                    'awb_date'                  =>  $request->awb_date,
                    'form_no'                   =>  $request->form_no,
                    'form_date'                 =>  $request->form_date,
                    // 'quantity'                  =>  $request->total_quantity,
                    // 'no_of_package'             =>  $request->no_of_packages,
                    // 'volume'                    =>  $request->volume,
                    'amount_in_words'           => $request->amount_in_words,
                    'description'               => $request->description,
                    // 'europe_shipment'           => $request->europe_shipment,
                    'customer_specific'         => $request->customer_specific,
                    'freight_rate'              => $request->freight_rate,

                ];
                if ($request->ship_to != '' || $request->ship_to != null) {
                    $attributes['ship_to'] = implode(",", $request->ship_to);
                }
                if ($request->payment_date != '') {
                    $attributes['payment_date'] = $request->payment_date;
                }
                // dd($attributes);
                // $object = InvoiceCreation::create($attributes);
                // $object = InvoiceCreation::where('id',$id)->update($attributes);

                // foreach ($request->invoice_creation_detail_id as $key => $value) 
                // {
                //     $detail_attributes = [
                //         'invoice_creation_id'        => $id,
                //         'perfoma_invoice_id'         => $request->perfoma_invoice_id[$key],
                //         'perfoma_invoice_detail_id'  => $value,
                //         'quantity'                   => $request->quantity[$key],
                //     ];
                //     // $object_detail = InvoiceCreationDetail::create($detail_attributes);
                //     $object_detail = InvoiceCreationDetail::where('id',$value)->update($detail_attributes);;
                // }

                $object = InvoiceCreation::where('id', $id)->update($attributes);

                // $object_detail = $object;
                // dd($request->invoice_creation_detail_id);
                InvoiceCreationDetail::where('invoice_creation_id', $id)->delete();
                if (isset($request->invoice_creation_detail_id)) {
                    foreach ($request->invoice_creation_detail_id as $key => $value) {

                        // foreach ($request->perfoma_invoice_detail_id as $key => $value) {



                        // if($value == 0) 
                        // {

                        $detail_attributes = [
                            'invoice_creation_id'        => @$id,
                            'perfoma_invoice_id'         => @$request->perfoma_invoice_id[$key],
                            'perfoma_invoice_detail_id'  => @$request->perfoma_invoice_detail_id[$key],
                            'quantity'                   => @$request->quantity[$key],
                        ];
                        $object_detail = InvoiceCreationDetail::create($detail_attributes);
                        // }
                        // else 
                        // {
                        //     $detail_attributes = [
                        //         // 'invoice_creation_id'        => @$id,
                        //         // 'perfoma_invoice_id'         => @$request->perfoma_invoice_id[$key],
                        //         // 'perfoma_invoice_detail_id'  => @$value,
                        //         'quantity'                   => @$request->quantity[$key],
                        //     ];

                        //     $object_detail = InvoiceCreationDetail::where('id',$value)->update($detail_attributes);


                        // }
                        // dd($detail_attributes);
                        // dd($object_detail);

                    }
                }
            });
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Some thing is wrong!');
        }
        return redirect()->route('invoice_creation.index')->with('success', 'Data is Successfully Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPerfomaInvoiceByCustomerId(Request $request)
    {
        try {

            /*
                start working for change status in perfoma invoice if it's all product is sent.  
            */
            // $perfomaInvoice = PerfomaInvoice::where([['customer_id','=',$request->customer_id],['status','=',0]])->get();
            $perfomaInvoice = PerfomaInvoice::where([['customer_id', '=', $request->customer_id]])->get();

            $perfoma_invoice_id = [];

            foreach ($perfomaInvoice as $key => $value) {
                $invoiceCreationDetail = InvoiceCreationDetail::where('perfoma_invoice_id', $value->id)->get();

                if ($invoiceCreationDetail != null) {
                    if ($value->perfomaInvoiceDetail->sum('quantity') == $invoiceCreationDetail->sum('quantity')) {
                        $perfomaInvoiceUpdate = PerfomaInvoice::where('id', $value->id)->update(['status' => 1]);
                    } else {
                        $perfomaInvoiceUpdate = PerfomaInvoice::where('id', $value->id)->update(['status' => 0]);
                    }
                }
            }
            /*
                End working for change status in perfoma invoice if it's all product is sent.  
            */
            $data = PerfomaInvoice::where([['customer_id', '=', $request->customer_id], ['status', '=', 0]])->get();
            // dd($data);
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

    public function getPerfomaInvoiceDetailsByPerfomaInvoice(Request $request)
    {
        // dd($request->all());
        try {
            $data = [];
            $object = PerfomaInvoice::find($request->id);

            foreach ($object->perfomainvoicedetail as $key => $value) {
                $invoiceCreationDetail = InvoiceCreationDetail::where('perfoma_invoice_detail_id', $value->id)->get();
                if (@$invoiceCreationDetail->sum('quantity') < $value->quantity) {
                    $data[] = [
                        'id'                        =>  @$value->id,
                        'perfoma_invoice_id'        =>  @$value->perfoma_invoice_id,
                        'perfoma_invoice_no_local'  =>  @$object->perfoma_invoice_no_local,
                        'product'                   =>  @$value->product->name,
                        'size'                      =>  @$value->size->name,
                        'quantity'                  =>  @$value->quantity - $invoiceCreationDetail->sum('quantity'),
                        'unit'                      =>  @measurementUnit()[$value->unit],
                        'carton'                    =>  @$value->carton,
                        'article_rate'              =>  @$value->article_rate,
                        'freight_rate'              =>  @$object->freight_rate
                    ];
                }
            }

            // dd($data);


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

    public function getPerfomaInvoiceDetails(Request $request)
    {
        try {
            $data = [];
            foreach ($request->id as $key => $item) {
                $value = PerfomaInvoiceDetail::find($item);
                $showInvoice = InvoiceCreationDetail::where('perfoma_invoice_detail_id', $value->id)->get(); {
                    $data[] = [
                        'id'                            => @$value->id,
                        'perfoma_invoice_id'            => @$value->perfoma_invoice_id,
                        'perfoma_invoice_no_local'      => @$value->perfomaInvoice->perfoma_invoice_no_local,
                        'freight_rate'                  => @$value->perfomaInvoice->freight_rate,
                        'product'                       => @$value->product->name,
                        'product_individual_packing'    => @$value->product->individual_packing,
                        'size'                          => @$value->size->name,
                        'quantity'                      => (@$value->quantity - @$showInvoice->sum('quantity')),
                        'unit'                          => @measurementUnit()[$value->unit],
                        'carton'                        => @$value->carton,
                        'article_rate'                  => @$value->article_rate,
                    ];
                }
            }



            // return ($data);

            // dd($data);


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

    public function getInvoiceCreationNoByCompanyInvoicePrefix($id)
    {
        $company = Company::find($id);

        $customer_ids = [];
        foreach ($company->customer as $key => $value) {
            $customer_ids[] = $value->id;
        }
        $invoice = '';
        $perfoma_invoice = InvoiceCreation::whereRaw("LEFT(invoice_no, 2) = LEFT(?, 2)", [$company->invoice_prefix])->count() + 1;
        
        
        $invoice = $company->invoice_prefix + $perfoma_invoice;
        return $invoice;
    }

    public function pdfReport($id)
    {
        if (ob_get_contents()) ob_end_clean();
        if (isset($id)) {
            $countries = Country::get();
            $data = InvoiceCreation::find($id);
            $detail_data = InvoiceCreationDetail::where('invoice_creation_id', $id)->get();
            $perfoma_freight_rate = InvoiceCreationDetail::where('invoice_creation_id', $id)->first();

            $total_carton = 0;
            $total_volume = 0;
            $carton = 0;
            $volume = 0;
            $carton_list = [];
            foreach ($detail_data as $key => $value) {
                @$carton = (@$value->quantity / @$value->perfomaInvoiceDetail->product->individual_packing);
                @$total_carton += @$carton;
                @$carton_list[] = @$carton;
                // dd($value->perfomaInvoiceDetail->product_id, $value->perfomaInvoiceDetail->size_id);     
                $temp_carton = 0.0;
                $temp_cbm = 0.0;

                if (@$carton != null) {
                    $temp_carton = (float)$carton;
                }

                $product_size_object = ProductSize::where([['product_id', '=', $value->perfomaInvoiceDetail->product_id], ['size_id', '=', $value->perfomaInvoiceDetail->size_id]])->first();
                if (@$product_size_object != null) {
                    // $temp_cbm = (float)$value->product_sizes->cbm;
                    // dd(ProductSize::where([['product_id','=', $value->perfomaInvoiceDetail->product_id], ['size_id','=',$value->perfomaInvoiceDetail->size_id]])->get());
                    $temp_cbm = (float)$product_size_object->cbm;
                }
                // dd($temp_cbm , $temp_carton);
                // $volume = ($value->perfomaInvoiceDetail->product->cbm * $carton);

                $volume = ($temp_cbm * $temp_carton);

                $total_volume += $volume;
            }

            $pdf = PDF::loadview('superadmin.invoice_creation.pdf_report', ['data' => $data, 'perfoma_freight_rate' => $perfoma_freight_rate, 'detail_data' => $detail_data, "countries" => $countries, "total_carton" => $total_carton, "total_volume" => $total_volume, "carton_list" => $carton_list,]);
            return $pdf->stream('pdf_report.pdf');
        }
    }

    public function exportExcel($id)
    {
        return Excel::download(new InvoiceCreationExport($id), 'invoices.xlsx');
        // Excel::create('New file', function($excel) {

        //     $excel->sheet('New sheet', function($sheet) {

        //         // $sheet->setAutoSize(true);
        //         $sheet->loadView('superadmin.invoice_creation.pdf_report');

        //     });

        // });
    }

    public function delete(Request $request)
    {
        InvoiceCreation::where('id', $request->id)->delete();
        InvoiceCreationDetail::where('invoice_creation_id', $request->id)->delete();

        return ["success" => "Successfully Deleted.", "redirect" => route('invoice_creation.index')];
    }

    public function getBankDetailsFromCompany($id)
    {
        $company = Company::find($id);
        $bank_details = $company->companyDetails;
        return view('includes.bankdropdown_partial', compact('bank_details'));
        // $customer_company = Customer::where('company_id','!=',null)->get();
    }
    public function getBankDetails($id)
    {
        $customer = Customer::find($id);
        $bank_details = $customer->company->companyDetails;
        return view('includes.bankdropdown_partial', compact('bank_details'));
        // $customer_company = Customer::where('company_id','!=',null)->get();
    }

    public function editBankDetails($id)
    {
        $customer = Customer::find($id);
        $bank_details = $customer->company->companyDetails;
        return view('includes.editbankdropdown_partial', compact('bank_details'));
        // $customer_company = Customer::where('company_id','!=',null)->get();
    }

    public function getShipTo($id)
    {
        $customer = Customer::find($id);
        $array = explode(',', $customer->address);
        // dd($array);
        return view('includes.shiptodropdown_partial', compact('array'));
        // $customer_company = Customer::where('company_id','!=',null)->get();
    }

    public function editShipTo($id)
    {
        $customer = Customer::find($id);
        // dd($customer->address);
        $array = explode(',', $customer->address);
        // dd($array);
        return view('includes.editshiptodropdown_partial', compact('array'));
        // $customer_company = Customer::where('company_id','!=',null)->get();
    }

    public function getCustomerCurrency($id)
    {
        $customers = Customer::find($id);
        $currency = currency()[$customers->currency];
        return response()->json(['currency' => $currency]);
    }
}