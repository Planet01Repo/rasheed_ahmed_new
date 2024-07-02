<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB as FacadesDB;

class PaymentLedgerDateExport implements FromView
{
    protected $data;


    function __construct($data)
    {
        $this->data = $data;

    }

    public function view(): View
    {

        $data = $this->data;

        return view('superadmin.reports-excel.payment-ledger-excel', ['data' => $data]);
    }
}
