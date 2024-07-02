<?php

namespace App\Exports;

use App\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Concerns\FromView;

class OrderStatusCompanyExport implements FromView
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {

        // if (isset($id)) {
        //     $data = FacadesDB::select("select perfoma_invoices.perfoma_invoice_no_local, companies.title, perfoma_invoices.po_number, products.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
        //     CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
        //         WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
        //         ELSE perfoma_invoice_details.quantity*1
        //     END as quantity_pairs, (select sum(invoice_creation_details.quantity) FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, products.individual_packing, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
        //     JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
        //     JOIN customers on perfoma_invoices.customer_id = customers.id
        //     JOIN companies on customers.company_id = companies.id
        //     JOIN products on perfoma_invoice_details.product_id = products.id
        //     JOIN sizes on perfoma_invoice_details.size_id = sizes.id where customers.company_id = {$id}");
        // dd($data);
        $customer = Customer::all();
        $data = $this->data;
        return view('superadmin.reports-excel.order-status-customer-excel', ['data' => $data, 'customer' => $customer]);
        // }
    }
}