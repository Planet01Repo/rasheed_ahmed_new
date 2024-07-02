<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
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
        
        $data = Size::orderBy('id', 'DESC')->get();
        return view('superadmin.size.view')->with(['title' => 'Size', 'data' => $data]);
    } 
    public function add(Request $request){
    	$data = "";
    	if(isset($request->id)){
    		$data = Size::where('id', $request->id)->first();
    	}
        return view('superadmin.size.add')->with(['title' => 'Size', 'data' => $data]);
    }

    public function post(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
        	if(Size::where('name', $request->name)->where('id', '!=', $request->id)->count() > 0){
	        	return ["error" => "Size Name is alredy in used."];
	        }
	        $data = Size::where('id', $request->id)->update([
                'name' => $request->name,
                'updated_by' => Auth::user()->id,
	        ]);
        }else{
	        if(Size::where('name', $request->name)->count() > 0){
	        	return ["error" => "Size Name is alredy in used."];
	        }


	        $data = new Size();
            $data->name = $request->name;
            $data->created_by = Auth::user()->id;
	        $data->save();

        }
        return ["success" => "Successfully Added.", "redirect" => route('size.view')];
    }
}

