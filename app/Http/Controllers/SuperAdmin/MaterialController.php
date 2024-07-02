<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Material;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
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
        
        $data = Material::orderBy('id', 'DESC')->get();
        return view('superadmin.material.view')->with(['title' => 'Materials', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = Material::where('id', $request->id)->first();
    	}
        return view('superadmin.material.add')->with(['title' => 'Material', 'data' => $data]);
    }

    public function post(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(Material::where('title', $request->title)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "Material Type is alredy in used."];
	        }
	        $data = Material::where('id', $request->id)->update([
                'title' => $request->title,
                'hand_cutting_rate' => $request->hand_cutting_rate,
                'press_cutting_rate' => $request->press_cutting_rate,
                'updated_by' => Auth::user()->id,
	        ]);
        }else{
	        if(Material::where('title', $request->title)->count() > 0){
	        	return ["error" => "Material Type is alredy in used."];
	        }


	        $data = new Material();
            $data->title = $request->title;
            $data->hand_cutting_rate = $request->hand_cutting_rate;
            $data->press_cutting_rate = $request->press_cutting_rate;
            $data->created_by = Auth::user()->id;
	        $data->save();

        }
        return ["success" => "Successfully Added.", "redirect" => route('material.view')];
    }
}

