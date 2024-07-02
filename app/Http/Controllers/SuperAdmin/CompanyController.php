<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Company;
use App\CompanyDetail;
use App\Image;
class CompanyController extends Controller
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
        $data = Company::orderBy('id', 'DESC')->get();
        return view('superadmin.company.view')->with(['title' => 'Companies', 'data' => $data]);
    } 
    public function add(Request $request){
        $data = "";
        if(isset($request->id)){
            $data = Company::where('id', $request->id)->first();
        }
        return view('superadmin.company.add')->with(['title' => 'Company', 'data' => $data, "ckeditor" => "yes"]);
    }

    public function post(Request $request){        
        $request->validate([
            'title'           => 'required',
            'prefix'          => 'required',
        ]);
        if(isset($request->id) && !empty($request->id)){
            if(Company::where('prefix', $request->prefix)->where('id', '!=', $request->id)->count() > 0){
                return ["error" => "Prefix is alredy in used."];
            }
            
            $curr_data = Company::where('id', $request->id)->first();
            
            $my_data = [
                'title'           => $request->title,
                'prefix'          => $request->prefix,
                'pi_prefix'       => $request->pi_prefix,
                'invoice_prefix'  => $request->invoice_prefix,
                'address'         => $request->address,
            ];
           

            if(isset($_FILES['fileToUpload']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $my_data['logo_image'] = @$new;

                }
            }

            if(isset($_FILES['fileToUpload2']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload2']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload2']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $my_data['header_image'] = @$new;

                }
            }

            if(isset($_FILES['fileToUpload3']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload3']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload3']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $my_data['footer_image'] = @$new;

                }
            }

            $data = Company::where('id', $request->id)->update($my_data);

            
        }else{
            if(Company::where('prefix', $request->prefix)->count() > 0){
                return ["error" => "Prefix is alredy in used."];
            }
            
            $data = new Company();
            $data->title = $request->title;
            $data->prefix = $request->prefix;
            $data->pi_prefix = $request->pi_prefix;
            $data->invoice_prefix = $request->invoice_prefix;
            $data->address = $request->address;
            
            
            if(isset($_FILES['fileToUpload']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $data->logo_image = @$new;

                }
            }

            if(isset($_FILES['fileToUpload2']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload2']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload2']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $data->header_image = @$new;

                }
            }

            if(isset($_FILES['fileToUpload3']['name'][0])){
                for($f=0; $f< (sizeof($_FILES['fileToUpload3']['name']) -1); $f++){
                    $filename  = basename($_FILES['fileToUpload3']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename']."_".time().'.'.$extension ;
                    move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"][$f], storage_path('company')."/{$new}");
                    
                    $data->footer_image = @$new;

                }
            }

            $data->save();

        }
        return ["success" => "Successfully Added.",  "redirect" => route('company.view')];
    }

    public function delete_image_logo(Request $request){
        $delete = File::delete(storage_path('company')."/".$request->file);
        Image::where('logo_image', $request->file)->delete();
        return 'true';
    }

    public function delete_image_header(Request $request){
        $delete = File::delete(storage_path('company')."/".$request->file);
        Image::where('header_image', $request->file)->delete();
        return 'true';
    }

    public function delete_image_footer(Request $request){
        $delete = File::delete(storage_path('company')."/".$request->file);
        Image::where('footer_image', $request->file)->delete();
        return 'true';
    }
}

