<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\FromView;

class ReceivableReport implements FromView
{
    private $data;
    private $request;
    public function __construct($data,$request)
    {
        $this->data       = $data;
        $this->request       = $request;
    }
    public function view(): View
    {
        $data = $this->data;
        $request = $this->request;
        
        return view('superadmin.reports-excel.receivable-report-excel',['data' => $data,'request'=>$request]);
        
    }
}
