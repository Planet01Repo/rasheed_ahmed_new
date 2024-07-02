<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\FromView;

class CustomInvoiceExport implements FromView
{
    private $id;
    public function __construct($id)
    {
        $this->id       = $id;
    }

    public function view(): View
    {
        $id = $this->id;

        if (isset($id)) {
            $data = FacadesDB::select("SELECT invoice_creations.invoice_no as invoice, invoice_creations.description as invoice_for, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, invoice_creations.shipped_per as shipped_per, customers.currency, invoice_creations.ship_to, invoice_creations.form_no, customers.country_id as country, companies.title, companies.address, companies.prefix as markd, sum(invoice_creation_details.quantity) * sum(invoice_creation_details.quantity) / sum(perfoma_invoice_details.article_rate) as amount, sum(invoice_creation_details.quantity) as quantity, sum(invoice_creation_details.quantity)/sum(perfoma_invoice_details.article_rate) as article_rate, sum(product_sizes.cbm) as cbm, perfoma_invoices.shipping_method, sum(product_sizes.net_weight_per_carton) as net_weight_per_carton, sum(product_sizes.gross_weight_per_carton) as gross_weight_per_carton, invoice_creations.form_date, invoice_creations.invoice_creation_date, perfoma_invoices.pi_date from invoice_creations
            JOIN customers on invoice_creations.customer_id = customers.id
            JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
            JOIN perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
            JOIN companies on customers.company_id = companies.id
            JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
            JOIN product_sizes on product_sizes.product_id = perfoma_invoice_details.product_id where invoice_creations.id = {$id} GROUP BY invoice_creations.invoice_no;");
            // dd($data);
            return view('superadmin.reports-excel.custom-invoice-excel', ['data' => $data]);
        }
    }
}
