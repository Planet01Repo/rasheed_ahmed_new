<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Size;
use App\Product;
use App\ProductMaterial;
use App\ProductSize;
use App\PerfomaInvoice;
use App\PerfomaInvoiceDetail;
use App\Material;
use App\Image;
use App\Customer;
use App\Country;
use App\Company;
use App\Carton;


class DeleteAllController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        
        return View('superadmin.delete')->with(['title' => 'Delete']);      
    }  
    public function post(Request $request){
        
        if(isset($request->size) ){
            Size::query()->truncate();
        }

        if(isset($request->product) ){
            Product::query()->truncate();
        }

        if(isset($request->product_material)){
            ProductMaterial::query()->truncate();
        }

        if(isset($request->product_size) ){
            ProductSize::query()->truncate();
        }

        if(isset($request->perfoma_invoice) ){
            PerfomaInvoice::query()->truncate();
        }

        if(isset($request->perfoma_invoice_detail)){
            PerfomaInvoiceDetail::query()->truncate();
        }

        if(isset($request->material) ){
            Material::query()->truncate();
        }

        if(isset($request->images) ){
            Image::query()->truncate();
        }

        if(isset($request->customer)){
            Customer::query()->truncate();
        }
        
        if(isset($request->country)){
            Country::query()->truncate();
        }

        if(isset($request->company)){
            Company::query()->truncate();
        }

        if(isset($request->carton) ){
            Carton::where('id', '>',  0)->delete();
            
        }

      return ["success" => "Successfully Deleted.", "reload" => true];

    }  
   

}

