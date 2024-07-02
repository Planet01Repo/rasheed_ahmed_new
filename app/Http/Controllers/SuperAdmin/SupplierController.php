<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Supplier;
use App\Country;
use App\Company;
class SupplierController extends Controller
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
        $data = Supplier::orderBy('id', 'DESC')->get();
        return view('superadmin.supplier.view')->with(['title' => 'Supplier', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = Supplier::where('id', $request->id)->first();
    	}
        return view('superadmin.supplier.add')->with(['title' => 'Supplier', 'data' => $data]);
    }

    public function post(Request $request){
        $request->validate([
            'name' => 'required',
            'contact_no' => 'required',
            'company_name' => 'required', 
            'email' => 'required', 
            
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(Supplier::where('contact_no', $request->contact_no)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "Phone no. is alredy in used."];
	        }
	        $data = Supplier::where('id', $request->id)->update([
	        	'name' => $request->name,
	        	'contact_no' => $request->contact_no,
	        	'email' => $request->email,
	        	'company_address' => $request->company_address,
	        	'currency' => $request->currency,
	        	'company_name' => $request->company_name,
	        	'created_by' => Auth::user()->id,
	        ]);
        }else{
	        if(Supplier::where('contact_no', $request->contact_no)->count() > 0){
	        	return ["error" => "Phone no. is alredy in used."];
	        }

	        $data = new Supplier();
	        $data->name       = $request->name;
            $data->contact_no      = $request->contact_no;
            $data->email      = @$request->email;
            $data->company_address    = $request->company_address;
            $data->currency    = $request->currency;
	        $data->company_name =$request->company_name;
	        $data->created_by = Auth::user()->id;
	        $data->save();

        }
        return ["success" => "Successfully Added.",  "redirect" => route('supplier.view')];
    }
    public function detail(Request $request)
    {   if(isset($request->id) && !empty($request->id)){
            $data = Supplier::where('id', $request->id)->first();
            if($data->count() > 0){
                return ["success" => "Record Succesfully Fetched.", "title" => 'Details', "rows" => $data];
            }else{
                return ['error' => 'Not Found.'];
            }
        }

       
    } 
}

