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
use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\PoMaterial;
use App\Supplier;

class PurchaseOrderController extends Controller
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
        $data = PurchaseOrder::with(['purchase_order_detail','supplier'])->orderBy('id', 'DESC')->get();
        return view('superadmin.purchase_order.view')->with(['title' => 'Purchase Order', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = PurchaseOrder::where('id', $request->id)->first();
            $detail_data = PurchaseOrderDetail::with(['po_material'])->where('po_id', $request->id)->get(); 
    	}else{
           $detail_data = "";
        }
        
        $material_data = PoMaterial::get(); 
        $supplier =  Supplier::get();
        // dd($customer);
        return view('superadmin.purchase_order.add')->with(['title' => 'Purchase Order', 'data' => $data,'detail_data' => $detail_data,"material_data" =>$material_data, "supplier" => $supplier, "ckeditor" => "yes"]);
    }

    public function post(Request $request){  
        $request->validate([
            'po_no' => 'required',
            'import_no' => 'required',
            'supplier_id' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(PurchaseOrder::where('po_no', $request->po_no)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "PO No is alredy in used."];
	        }
	        $data = PurchaseOrder::where('id', $request->id)->update([
	            'po_no' => @$request->po_no,
                'supplier_id' => @$request->supplier_id,
                'date' => @$request->date,
                'import_no' => @$request->import_no,
                'payment_terms' => @$request->payment_terms,
                'shipping_method' => @$request->shipping_method,
                'price_base' => @$request->price_base,
                'notes' => @$request->notes,
                'updated_by' => Auth::user()->id
                
	        ]);
            
            PurchaseOrderDetail::where('po_id', $request->id)->delete();
            if(isset($request->po_material_id)){
                $po_material_id = $request->po_material_id;
                for($k = 0; $k< sizeof($po_material_id); $k++)
                {
                    $detail_data = new PurchaseOrderDetail();
                    $detail_data->po_id = $request->id;
                    $detail_data->po_material_id = $request->po_material_id[$k];
                    $detail_data->quantity = $request->quantity[$k];
                    $detail_data->unit = $request->unit[$k];
                    $detail_data->rate = $request->rate[$k];
                    $detail_data->save();
                }
            }

            

        }else{
	        if(PurchaseOrder::where('po_no', $request->po_no)->count() > 0){
	        	return ["error" => "PO No is alredy in used."];
	        }

	        $data = new PurchaseOrder();
	        $data->po_no = $request->po_no;
	        $data->import_no = $request->import_no;
	        $data->date = $request->date;
            $data->supplier_id = @$request->supplier_id;
            $data->payment_terms = @$request->payment_terms;
            $data->shipping_method = @$request->shipping_method;
            $data->price_base = @$request->price_base;
            $data->notes = @$request->notes;
            $data->created_by = Auth::user()->id;
            $data->save();
            
            if(isset($request->po_material_id)){
                $po_material_id = $request->po_material_id;
                for($k = 0; $k< sizeof($po_material_id); $k++)
                {
                    $detail_data = new PurchaseOrderDetail();
                    $detail_data->po_id = $data->id;
                    $detail_data->po_material_id = $request->po_material_id[$k];
                    $detail_data->quantity = $request->quantity[$k];
                    $detail_data->unit = $request->unit[$k];
                    $detail_data->rate = $request->rate[$k];
                    $detail_data->save();
                }
            }
          
        }
        return ["success" => "Successfully Added.", "redirect" => route('purchase_order.view')];
    }
    public function detail(Request $request)
    {   
        $data = PurchaseOrder::with(['purchase_order_detail.po_material','supplier'])->where('id', $request->id)->first();
        return view('superadmin.purchase_order.detail')->with(['title' => 'Purchase Order Detail', 'data' => $data]);
    }

    public function pdf_report(Request $request){
        if(isset($request->id)){
            $data = PurchaseOrder::with(['purchase_order_detail.po_material','supplier'])->where('id', $request->id)->first();
            $pdf = PDF::loadview('superadmin.purchase_order.pdf_report',['data' => $data]);
            return $pdf->stream('pdf_report.pdf');
        }
    }

    public function delete(Request $request){
        PurchaseOrder::where('id', $request->id)->delete();
        PurchaseOrderDetail::where('po_id', $request->id)->delete();
        
        return ["success" => "Successfully Deleted.", "redirect" => route('purchase_order.view')];

    }
}

