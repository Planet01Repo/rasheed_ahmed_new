<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB as FacadesDB;

class InvoicePackingListExport implements FromView
{
    protected $data;
    protected $table_detail;


    function __construct($data,$table_detail)
    {
        $this->data = $data;
        $this->table_detail = $table_detail;

    }

    public function view(): View
    {

        $data = $this->data;
        $table_detail = $this->table_detail;

        return view('superadmin.reports-excel.invoice-packing-list-excel', ['data' => $data, 'table_detail' => $table_detail]);
    }
}
