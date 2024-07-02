<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Carton;
use Illuminate\Support\Facades\Auth;

class CartonController extends Controller
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
        
        $data = Carton::orderBy('id', 'DESC')->get();
        return view('superadmin.carton.view')->with(['title' => 'Carton', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = Carton::where('id', $request->id)->first();
    	}
        return view('superadmin.carton.add')->with(['title' => 'Carton', 'data' => $data]);
    }

    public function post(Request $request){
        $request->validate([
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(Carton::where('length', $request->name)->where('height', $request->height)->where('width', $request->width)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "Carton alredy in used."];
	        }
	        $data = Carton::where('id', $request->id)->update([
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'updated_by' => Auth::user()->id,
	        ]);
        }else{
	        if(Carton::where('length', $request->name)->where('height', $request->height)->where('width', $request->width)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "Carton alredy in used."];
	        }


	        $data = new Carton();
            $data->length = $request->length;
            $data->width = $request->width;
            $data->height = $request->height;
            $data->created_by = Auth::user()->id;
	        $data->save();

        }
        return ["success" => "Successfully Added.", "redirect" => route('carton.view')];
    }
}

