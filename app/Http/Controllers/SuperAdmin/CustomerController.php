<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Customer;
use App\Country;
use App\Company;
use App\CompanyDetail;

class CustomerController extends Controller
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
        $data = Customer::with(['company', 'country'])->orderBy('id', 'DESC')->get();
        return view('superadmin.customer.view')->with(['title' => 'Customers', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = Customer::where('id', $request->id)->first();
    	}
        
        $countries = Country::get();
        $companies = Company::get();
        $company_details = CompanyDetail::get();
        return view('superadmin.customer.add')->with(['title' => 'Customer', 'data' => $data, "countries" => $countries, "companies" => $companies, "company_details" => $company_details]);
    }

    public function post(Request $request){
        // dd($request->all());
        $request->validate([
            // 'uname' => 'required',
            // 'phone' => 'required',
            // 'city' => 'required',
            // 'country_id' => 'required',
            // 'customer_company_name' => 'required', 
            // 'company_id' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	// if(Customer::where('phone', $request->phone)->where('id', '!=', $request->id)->count() > 0){
	        // 	return ["error" => "Phondcasfase no. is alredy in used."];
	        // }
	        $data = Customer::where('id', $request->id)->update([
	        	'name' => $request->uname,
	        	// 'phone' => $request->phone,
	        	// 'email' => $request->email,
	        	// 'website' => $request->website,
	        	'city' => $request->city,
	        	'country_id' => $request->country_id,
                'customer_company_name' => $request->customer_company_name,
	        	'address' => $request->address,
                'bill_to' => $request->bill_to,
                'credit_days' => $request->credit_days,
                'payment_terms' => $request->payment_terms,
                'price_base' => $request->price_base,
                'customer_code' => $request->customer_code,
	        	'currency' => $request->currency,
	        	'company_id' => $request->company_id,
                'europe_shipment' => $request->europe_shipment,
                'company_detail_id' =>  $request->company_detail_id
                
	        ]);
        }else{
	        // if(Customer::where('phone', $request->phone)->count() > 0){
	        // 	return ["error" => "Phone no. is alredy in used."];
	        // }

	        $data = new Customer();
	        $data->name       = $request->uname;
            // $data->phone      = $request->phone;
            // $data->email      = @$request->email;
            // $data->website    = @$request->website;
            $data->city                     =             $request->city;
            $data->country_id               =             $request->country_id;
            $data->customer_company_name    =             $request->customer_company_name;
            $data->address                  =             $request->address;
            $data->bill_to                  =             $request->bill_to;
            $data->credit_days              =             $request->credit_days;
            $data->payment_terms            =             $request->payment_terms;
            $data->price_base               =             $request->price_base;
            $data->customer_code            =             $request->customer_code;
            $data->currency                 =             $request->currency;
	        $data->company_id               =             $request->company_id;
            $data->europe_shipment          =             $request->europe_shipment;
            $data->company_detail_id        =             $request->company_detail_id;
	        $data->save();

        }
        return ["success" => "Successfully Added.",  "redirect" => route('customer.view')];
    }
    public function detail(Request $request)
    {   if(isset($request->id) && !empty($request->id)){
            $data = Customer::with(['company', 'country'])->where('id', $request->id)->first();
            if($data->count() > 0){
                return ["success" => "Record Succesfully Fetched.", "title" => 'Details', "rows" => $data];
            }else{
                return ['error' => 'Not Found.'];
            }
        }

    } 
}

