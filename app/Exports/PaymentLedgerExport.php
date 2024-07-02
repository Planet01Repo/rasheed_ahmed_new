<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentLedgerExport implements FromView
{
    private $data;
    public function __construct($data)
    {
        $this->data       = $data;
    }

    public function view(): View
    {

        // if(isset($id)){
        //     $data = FacadesDB::select("SELECT customers.name, invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
        //     JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
        //     JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
        //     JOIN customers on invoice_creations.customer_id = customers.id WHERE customers.id = {$id} GROUP BY invoice_creations.invoice_no;");
        // dd($data);
        $data = $this->data;
        return view('superadmin.reports-excel.payment-ledger-excel', ['data' => $data]);
        // }
    }
}