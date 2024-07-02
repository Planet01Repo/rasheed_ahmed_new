<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PoMaterial;
use Illuminate\Support\Facades\Auth;

class PoMaterialController extends Controller
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
        
        $data = PoMaterial::orderBy('id', 'DESC')->get();
        return view('superadmin.po_material.view')->with(['title' => 'PO Materials', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = PoMaterial::where('id', $request->id)->first();
    	}
        return view('superadmin.po_material.add')->with(['title' => 'PO Material', 'data' => $data]);
    }

    public function post(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(PoMaterial::where('name', $request->name)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "PO Material Name is alredy in used."];
	        }
	        $data = PoMaterial::where('id', $request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'code' => $request->code,
                'price' => $request->price,
                'unit' => $request->unit,
	        ]);
        }else{
	        if(PoMaterial::where('name', $request->name)->count() > 0){
	        	return ["error" => "PO Material Name is alredy in used."];
	        }


	        $data = new PoMaterial();
            $data->name = $request->name;
            $data->description = $request->description;
            $data->code = $request->code;
            $data->price = $request->price;
            $data->unit = $request->unit;
	        $data->save();

        }
        return ["success" => "Successfully Added.", "redirect" => route('po_material.view')];
    }
}

