<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Visitor;
use App\VisitorLog;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
class VisitorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //getAllUser_post
    public function visitor_list(){
        $data = Visitor::get();
        if(!empty($data) &&  count($data) > 0){
            return response()->json([
                "status" => TRUE,
                "data" => $data,
                "message" => "Data Fetched."
            ]);
        }else{
            return response()->json([
                "status" => FALSE,
                "data" => $data,
                "message" => "Data not found."
            ]);
        }
    }
    //getCheckedInUser_post
    public function missing_checked_list(){
        $data = Visitor::with(['visitor_logs' => function($q) {
                        $q->where('check_in', null)->orwhere('check_out', null); 
                    }])->get();
        if ($data) {
            return response()->json([
                'status' => TRUE,
                'data' => $data,
                'message' => "Data Fetched"
            ]);

        } else {
            $data = array();
            return response()->json([
                'status' => FALSE,
                'data' => $data,
                'message' => "Data not found."
            ]);
        }
    }
    //getCheckedInUser_post
    public function missing_checked_out_list(){
        $data = Visitor::with(['visitor_logs' => function($q) {
                        $q->where('check_out', null); 
                    }])->get();
        if (!empty($data) &&  count($data) > 0) {
            return response()->json([
                'status' => TRUE,
                'data' => $data,
                'message' => "Data Fetched"
            ]);

        } else {
            $data = array();
            return response()->json([
                'status' => FALSE,
                'data' => $data,
                'message' => "Data not found."
            ]);
        }
    }
    //getCheckedOutUser_post
    public function checked_list(){
       $data = Visitor::with(['visitor_logs' => function($q) use($value) {
                        $q->where('check_in', '!=', null)->orwhere('check_out', '!=', null); 
                    }])->get();
        if (!empty($data) &&  count($data) > 0) {
            return response()->json([
                'status' => TRUE,
                'data' => $data,
                'message' => "Data Fetched"
            ]);

        } else {
            $data = array();
            return response()->json([
                'status' => FALSE,
                'data' => $data,
                'message' => "Data not found."
            ]);
        }
    }

    //addUser_post
    public function add(Request $request){
   
        $request->validate([
            'phone' => 'required',
            'contact_person' => 'required',
            'ck_purpose' => 'required',
            'check_in' => 'required',
        ]);
        $visitor_phone = $request->phone;
        //find missing entry & validate
        $missing_data = Visitor::with(['visitor_logs' => function($q){
                        $q->where('check_in',  null)->orwhere('check_out', null); 
                    }])->where('phone',  $visitor_phone)->first();
        if(!empty($missing_data->visitor_logs) && $missing_data->visitor_logs != null && count($missing_data->visitor_logs) > 0){
             return response()->json([
                'status' => FALSE,
                'data' => [],
                'message' => "User did not checked in/'out."
            ]);
        }
        $data = Visitor::where('phone',  $visitor_phone)->first();
        if (empty($data)){
            $request->validate([
                'name' => 'required',
                'nic' => 'required',
                'company' => 'required',
                'photo' => 'required',
            ]);
            $data = new Visitor();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->nic = $request->nic;
            $data->company = $request->company;
            $image = $request->photo;  
            if($image){
                $image = explode(";base64,", $image);
                $image_type = explode("image/", @$image[0]);
                $ext = @$image_type[1];
                $image = base64_decode(@$image[1]);
                $now = Carbon::now();
                $unique_code = $now->format('YmdHisu');
                $imageName = $unique_code.'.'.$ext;
                $target_dir = storage_path('visitor/').$imageName;
                $upload = file_put_contents($target_dir, $image);
                $data->photo = $imageName;
            }
            $data->save();
        }
        $qr_code = VisitorLog::orderBy('id', 'desc')->first();
        $qr_code = ($qr_code)? $qr_code->id+1 : 1;
        $qr_code = md5($qr_code);
        $log_data = new VisitorLog();
        $log_data->visitor_id = $data->id;
        $log_data->contact_person = $request->contact_person;
        $log_data->purpose = $request->ck_purpose;
        $log_data->check_in = $request->check_in;
        $log_data->qr_code = $qr_code;
        $log_data->save();
        return response()->json([
            'status' => TRUE,
            'data' => ['qr_code' => $qr_code],
            'message' => "Data inserted."
        ]);
    }
    //updateLog_post
    public function post_checked_out(Request $request)
    {   
        $request->validate([
            'ck_qr_code' => 'required',
            'ck_out' => 'required',
        ]);
        $ck_qr_code = $request->ck_qr_code;
        VisitorLog::where('qr_code', $ck_qr_code)->update(['check_out' => $request->ck_out]);
        return response()->json([
            'status' => TRUE,
            'data' => ['ck_out' => $request->ck_out],
            'message' => "Data inserted."
        ]);
    }
    
    

}

