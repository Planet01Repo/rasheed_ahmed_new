<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Customer;
use App\PerfomaInvoice;
use App\PerfomaInvoiceDetail;
use App\ProductMaterial;
use App\ProductSize;
use App\Product;
use App\Country;
use App\Image;
use App\Company;
use App\InvoiceCreation;
use App\InvoiceCreationDetail;
use App\PackingListDetail;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceCreationExport implements FromView
{
    private $id;
    public function __construct($id)
    {
        $this->id       = $id;
    }

    public function view(): View
    {
        $id = $this->id;
        
        if(isset($id)){
            $countries = Country::get();
            $data = InvoiceCreation::find($id);
            $detail_data = InvoiceCreationDetail::where('invoice_creation_id', $id)->get();
            $perfoma_freight_rate = InvoiceCreationDetail::where('invoice_creation_id', $id)->first();
            $total_carton = 0;
            $total_volume = 0;
            $carton = 0;
            $volume = 0;
            $carton_list = [];
            foreach ($detail_data as $key => $value) 
            {
                @$carton = ( @$value->quantity / @$value->perfomaInvoiceDetail->product->individual_packing);
                @$total_carton += @$carton;
                @$carton_list[] = @$carton;
                $temp_carton = 0.0;
                $temp_cbm = 0.0;
                
                if (@$carton != null) 
                {
                    $temp_carton = (float)$carton;                    
                }
                
                $product_size_object = ProductSize::where([['product_id','=', $value->perfomaInvoiceDetail->product_id], ['size_id','=',$value->perfomaInvoiceDetail->size_id]])->first();
                if (@$product_size_object != null) 
                {   
                    $temp_cbm = (float)$product_size_object->cbm;
                }

                $volume = ($temp_cbm * $temp_carton);
                
                $total_volume += $volume;
            }

            return view('superadmin.invoice_creation.test_excel',['data' => $data,'detail_data' => $detail_data, "perfoma_freight_rate" => $perfoma_freight_rate, "countries" => $countries,"total_carton"=>$total_carton,"total_volume"=>$total_volume,"carton_list"=>$carton_list]);
    }
    }
}
