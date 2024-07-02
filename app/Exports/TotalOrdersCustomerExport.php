<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class TotalOrdersCustomerExport implements FromView
{
    // private $id;
    protected $data;
    public function __construct($data)
    {
        $this->data       = $data;
    }

    public function view(): View
    {
        // $id = $this->id;

        // if (isset($id)) {
        //     $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, products.hs_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
        //     join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
        //     join products on perfoma_invoice_details.product_id = products.id
        //     join sizes on perfoma_invoice_details.size_id = sizes.id
        //     join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.customer_id = {$id}");
        // dd($data);
        $data = $this->data;
        // dd($data);
        return view('superadmin.reports-excel.total-orders-excel', ['data' => $data]);
        // }
    }
}