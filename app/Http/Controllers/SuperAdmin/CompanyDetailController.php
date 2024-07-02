<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Company;
use App\CompanyDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class CompanyDetailController extends Controller
{
    public function index($company_id){
        $data = "";
        if(isset($company_id)){
            $company = Company::where('id', $company_id)->first();
            $data = CompanyDetail::where('company_id', $company_id)->get();
            // dd($company->id);
        }
        return view('superadmin.company.add_bank_details')->with(['title' => 'Company', 'data' => $data, 'company' => $company, "ckeditor" => "yes"]);
    }
    public function saveBankDetails(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'branch_name'     => 'required',
            'branch_address'  => 'required',
            'branch_code'     => 'required',
            'account_name'    => 'required',
            'account_number'  => 'required|unique:company_details,account_number',
            'iban_number'     =>  'required|unique:company_details,iban_number',
            'swift_code'      => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $details = new CompanyDetail();
        $details->company_id     =  @$request->company_id;
        $details->branch_name    =  @$request->branch_name;
        $details->branch_address =  @$request->branch_address;
        $details->branch_code    =  @$request->branch_code;
        $details->account_name   =  @$request->account_name;
        $details->account_number =  @$request->account_number;
        $details->iban_number    =  @$request->iban_number;
        $details->swift_code     =  @$request->swift_code;
        $details->save();
        return response()->json(['status'=>true, 'success'=>"Bank Details added sccessfully"]);
    }
    public function editBankDetails($id)
    {
        $company = CompanyDetail::findOrFail($id);
        // dd($company);
        return view('superadmin.company.edit_bank_details')->with(['title' => 'Company', 'company' => $company, "ckeditor" => "yes"]);
    }
    public function updateBankDetails(Request $request)
    {
        $company = CompanyDetail::findOrFail($request->id);
        $company->branch_name    =  @$request->branch_name;
        $company->branch_address =  @$request->branch_address;
        $company->branch_code    =  @$request->branch_code;
        $company->account_name   =  @$request->account_name;
        $company->account_number =  @$request->account_number;
        $company->iban_number    =  @$request->iban_number;
        $company->swift_code     =  @$request->swift_code;
        // dd($company);
        $company->save();
        return response()->json(['status'=>true, 'success'=>"Bank Details updated successfully"]);
    }
    public function deleteBankDetails($id)
    {
        CompanyDetail::findOrFail($id)->delete();
        return ["success" => "Successfully Deleted.", "redirect" => route('companydetails.index')];
    }
}
?>