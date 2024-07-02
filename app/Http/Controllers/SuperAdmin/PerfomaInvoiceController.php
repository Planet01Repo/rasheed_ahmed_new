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
use App\PerfomaInvoice;
use App\PerfomaInvoiceDetail;
use App\ProductMaterial;
use App\ProductSize;
use App\Product;
use PDF;
use App\Country;
use App\Image;
use App\Company;
use App\InvoiceCreationDetail;

class PerfomaInvoiceController extends Controller
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
        $data = PerfomaInvoice::with(['perfomainvoicedetail','customer'])->orderBy('id', 'DESC')->get();
        // $customer =  PerfomaInvoice::with(['customer'])->get();
        // dd($data->customer->company->title);
        return view('superadmin.perfoma_invoice.view')->with(['title' => 'Proforma Invoice', 'data' => $data]);
    }
    public function add(Request $request){
                // dd($request->all());

    	$data = "";
    	if(isset($request->id)){
    		$data = PerfomaInvoice::where('id', $request->id)->first();
            $detail_data = PerfomaInvoiceDetail::where('perfoma_invoice_id', $request->id)->get();
            // dd($data);
    	}else{
           $detail_data = "";
        }

        $product_data = Product::with(['productsize.size','images', 'productmaterial.material'])->where('customer_id', NULL)->get();
        $customer =  Customer::with(['company', 'country'])->get();
        // dd($customer);
        return view('superadmin.perfoma_invoice.add')->with(['title' => 'Proforma Invoice', 'data' => $data,'detail_data' => $detail_data,"product_data" =>$product_data, "customer" => $customer, "ckeditor" => "yes"]);
    }

    public function post(Request $request){
        // dd($request->all());
        $request->validate([
            'perfoma_invoice_no_local' => 'required',
            'customer_id' => 'required',
        ]);

        // $invoice = $this->getPerfomaInvoiceNoByCompanyInvoicePrefix($request->company_id);
        // dd($temp);
        if(isset($request->id))
        {
            // dd('bilal');
        	// if(PerfomaInvoice::where('perfoma_invoice_no_local', $request->perfoma_invoice_no_local)->where('id', '!=', $request->id)->count() > 0){
	        // 	return ["error" => "Invoice No is alredy in used."];
	        // }
	        $data = PerfomaInvoice::where('id', $request->id)->update([
                'customer_id' => @$request->customer_id,
                'po_number'  => @$request->po_number,
                'pi_date'   => @$request->pi_date,
                'perfoma_invoice_no_local'  =>  @$request->perfoma_invoice_no_local,
                'accepted_date'  =>  @$request->accepted_date,
                'freight_rate'  =>  @$request->freight_rate,
                'updated_by' => Auth::user()->id
	        ]);
            // dd($data);

            PerfomaInvoiceDetail::where('perfoma_invoice_id', $request->id)->whereNotIn('id', $request->invoice_detail_id)->delete();
            InvoiceCreationDetail::where('perfoma_invoice_id', $request->id)->whereNotIn('perfoma_invoice_detail_id',$request->invoice_detail_id)->delete();
            
            if(isset($request->product_id)){
                $product_id = $request->product_id;
                for($k = 0; $k< sizeof($product_id); $k++)
                {
                    if($request->invoice_detail_id[$k] == 0){
                        $detail_data = new PerfomaInvoiceDetail();
                    }
                    else {
                        $detail_data = PerfomaInvoiceDetail::find($request->invoice_detail_id[$k]);
                    }
                    $detail_data->perfoma_invoice_id = $request->id;
                    $detail_data->product_id = $request->product_id[$k];
                    $detail_data->size_id = $request->size_id[$k];
                    $detail_data->quantity = $request->quantity[$k];
                    $detail_data->unit = $request->unit[$k];
                    $detail_data->carton = $request->carton[$k];
                    $detail_data->article_rate = $request->article_rate[$k];
                    $detail_data->processed_at = $request->processed_at[$k];
                    // dd($detail_data->id);
                    $detail_data->save();
                }
            }



        }else{
            $invoice = $this->getPerfomaInvoiceNoByCompanyInvoicePrefix($request->company_id);

	        // if(PerfomaInvoice::where('perfoma_invoice_no', $request->perfoma_invoice_no)->count() > 0)
	        if(PerfomaInvoice::where('perfoma_invoice_no_local', $invoice)->count() > 0)
            {
	        	return ["error" => "Invoice No is alredy in used."];
	        }

	        $data = new PerfomaInvoice();
	        $data->perfoma_invoice_no_local = $request->perfoma_invoice_no_local;
            $data->customer_id = @$request->customer_id;
            $data->po_number = $request->po_number;
            $data->freight_rate = $request->freight_rate;
            // $data->pi_date = $request->pi_date;
            // $data->accepted_date = $request->accepted_date;
            $data->created_by = Auth::user()->id;
            if($request->pi_date!=''){
                $data->pi_date = $request->pi_date;
            }
            if($request->accepted_date!=''){
                $data->accepted_date = $request->accepted_date;
            }
            // dd($data);
            $data->save();

            if(isset($request->product_id)){
                $product_id = $request->product_id;
                for($k = 0; $k< sizeof($product_id); $k++)
                {
                    $detail_data = new PerfomaInvoiceDetail();
                    $detail_data->perfoma_invoice_id = $data->id;
                    $detail_data->product_id = $request->product_id[$k];
                    $detail_data->size_id = $request->size_id[$k];
                    $detail_data->quantity = $request->quantity[$k];
                    $detail_data->unit = $request->unit[$k];
                    $detail_data->carton = $request->carton[$k];
                    $detail_data->article_rate = $request->article_rate[$k];
                    $detail_data->processed_at = $request->processed_at[$k];
                    $detail_data->save();
                }
            }

        }
        return ["success" => "Successfully Added.", "redirect" => route('perfoma_invoice.view')];
    }
    public function detail(Request $request)
    {
        $data = PerfomaInvoice::with(['perfomainvoicedetail.product','perfomainvoicedetail.size','customer'])->where('id', $request->id)->first();
        return view('superadmin.perfoma_invoice.detail')->with(['title' => 'Proforma Invoice Detail', 'data' => $data]);
    }

    public function pdf_report(Request $request){
        if (ob_get_contents()) ob_end_clean();
        if(isset($request->id)){
            $countries = Country::get();
            $data = PerfomaInvoice::with(['customer'])->where('id', $request->id)->first();
            $detail_data = PerfomaInvoiceDetail::with(['product','size'])->where('perfoma_invoice_id', $request->id)->get();

            $pdf = PDF::loadview('superadmin.perfoma_invoice.pdf_report',['data' => $data,'detail_data' => $detail_data,"countries" => $countries])->setPaper('a3', 'landscape');
            return $pdf->stream('pdf_report.pdf');


            // return view('superadmin.perfoma_invoice.pdf_report')->with(['data' => $data,'detail_data' => $detail_data,"countries" => $countries]);
        }
    }

    public function customer_product(Request $request)
    {
        $data['data'] = Product::with(['productsize.size','images', 'productmaterial.material'])->where('customer_id', $request->customer_id)->get();
        $data['measurementUnit'] = measurementUnit();
        $data['cities'] = cities();
        return json_encode($data);
    }

    public function delete(Request $request){
        PerfomaInvoice::where('id', $request->id)->delete();
        PerfomaInvoiceDetail::where('perfoma_invoice_id', $request->id)->delete();

        return ["success" => "Successfully Deleted.", "redirect" => route('perfoma_invoice.view')];

    }

    public function getPerfomaInvoiceNoByCompanyInvoicePrefix($id)
    {
        $company = Company::find($id);

        $customer_ids = [];
        foreach ($company->customer as $key => $value)
        {
            $customer_ids[] = $value->id;
        }

        $perfoma_invoice = PerfomaInvoice::whereIn('customer_id',$customer_ids)->get();

        // dd(max($perfoma_invoice));
        $perfoma_invoice_no = [];
        foreach ($perfoma_invoice as $key => $value)
        {
            $perfoma_invoice_no[] = $value->perfoma_invoice_no_local;
        }
        // dd($perfoma_invoice_no);
        // dd(max(array_keys($perfoma_invoice_no)));

        // if (!empty($perfoma_invoice_no))
        // {

        // }
        // $max_key = max(array_keys($perfoma_invoice_no));
        // // $perfoma_invoice_no_max = max($perfoma_invoice_no);
        // $perfoma_invoice_no_max = $perfoma_invoice_no[$max_key];

        // // dd($perfoma_invoice_no_max);
        // $prefix = explode('-',$perfoma_invoice_no_max);
        // // dd($prefix);
        // // dd($company->prefix);
        // $invoice = 0;
        // if($prefix[0] == $company->prefix)
        // {
        //     $temp = (int)$company->invoice_prefix;
        //     $invoice = (int)$prefix[1];
        //     $invoice = $invoice + $temp + 1;
        // }
        // // elseif($prefix[0] == $company->invoice_prefix)
        // // {
        // //     $invoice = (int)$prefix[0] + 1;
        // // }
        // else{
        //     $invoice = (int)$prefix[0] + 1;
        // }

        if(!empty($perfoma_invoice_no))
        {

            $max_key = max(array_keys($perfoma_invoice_no));
            $perfoma_invoice_no_max = $perfoma_invoice_no[$max_key];
            if ($perfoma_invoice_no_max != null )
            {
                $prefix = explode('-',$perfoma_invoice_no_max);
                if($prefix[0] == $company->prefix)
                {
                    $temp = (int)$company->invoice_prefix;
                    $invoice = (int)$prefix[1];
                    $invoice = $invoice + $temp + 1;
                }
                else{
                    $invoice = (int)$prefix[0] + 1;
                }
            }
            else{
                $temp = (int)$company->invoice_prefix;
                $invoice = $temp + 1;
            }

        }
        else{
            $temp = (int)$company->invoice_prefix;
            $invoice = $temp + 1;
        }

        $invoice = $invoice.'-'.date('y');
        return $invoice;

    }
}

