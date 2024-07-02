<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB as FacadesDB;

class OrderShippedPlanExport implements FromView
{
    protected $data;
    protected $quantities;


    function __construct($data,$quantities)
    {
        $this->data = $data;
        $this->quantities = $quantities;

    }

    public function view(): View
    {

        $data = $this->data;
        $quantities = $this->quantities;

        return view('superadmin.reports-excel.order-shipped-plan-excel', ['data' => $data, 'quantities' => $quantities]);
    }
}
