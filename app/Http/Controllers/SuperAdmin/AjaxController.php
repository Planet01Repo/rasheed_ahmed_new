<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getCustomersByCompany($companyId){
        $customers = Customer::where('company_id',$companyId)->get();
        return view('superadmin.ajax.get_customer_by_company',compact('customers'));
    }
    public function getPIByCustomer($customerId){
        $customers = Customer::where('company_id',$customerId)->get();
        return view('superadmin.ajax.get_customer_by_company',compact('customers'));
    }
}
