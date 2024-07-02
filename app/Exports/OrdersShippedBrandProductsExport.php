<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersShippedBrandProductsExport implements FromView
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
            $data = FacadesDB::select("select invoice_creations.invoice_no, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
            join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
            join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
            join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
            JOIN customers on invoice_creations.customer_id = customers.id
            JOIN products on perfoma_invoice_details.product_id = products.id
            JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND products.branded_products ='{$id}'");
            // dd($data);

            return view('superadmin.reports-excel.order-shipped-excel',['data' => $data]);
        }
    }
}
