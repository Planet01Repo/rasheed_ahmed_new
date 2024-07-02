<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Brand;
use PDF;
use App\Company;
use App\Product;
use App\Customer;
use App\Exports\CustomInvoiceExport;
use App\Exports\InvoicePackingListExport;
use App\Exports\OrderStatusCompanyExport;
use App\Exports\OrderStatusCustomerExport;
use App\Exports\TotalOrdersCompanyExport;
use App\Exports\TotalOrdersCustomerExport;
use App\Exports\TotalOrdersPerfomaInvoiceExport;
use App\Http\Controllers\Controller;
use App\PerfomaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderShippedPlanExport;
use App\Exports\OrderShippedCompanyExport;
use App\Exports\OrderShippedCustomerExport;
use App\Exports\OrderShippedDateExport;
use App\Exports\OrdersShippedBrandProductsExport;
use App\Exports\PaymentLedgerDateExport;
use App\Exports\PaymentLedgerExport;
use App\Exports\ReceivableReport;
use App\Exports\TotalOrdersDateExport;
use App\InvoiceCreation;
use App\InvoiceCreationDetail;
use App\PackingList;
use Validator;
use Redirect;
// use Collection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Conditional;

class ReportsController extends Controller
{
    public function viewTotalOrders()
    {
        $data = PerfomaInvoice::with(['perfomainvoicedetail', 'customer'])->orderBy('id', 'DESC')->get();
        $customer = Customer::all();
        $company = Company::all();
        // dd($products);
        return view('superadmin.reports.view-total-orders')->with(['title' => 'Proforma Invoice', 'data' => $data, 'customer' => $customer, 'company' => $company]);
    }
    public function viewOrdersShipped()
    {
        $data = PerfomaInvoice::with(['perfomainvoicedetail', 'customer'])->orderBy('id', 'DESC')->get();
        $products = Product::all();
        $branded_products = Brand::where('is_active', 1)->get();
        $customer = Customer::all();
        $company = Company::all();
        return view('superadmin.reports.view-orders-shipped')->with(['title' => 'Proforma Invoice', 'data' => $data, 'branded_products' => $branded_products, 'products' => $products, 'customer' => $customer, 'company' => $company]);
    }
    public function viewOrderStatus()
    {
        $data = PerfomaInvoice::with(['perfomainvoicedetail', 'customer'])->orderBy('id', 'DESC')->get();
        $customer = Customer::all();
        $company = Company::all();
        // dd($products);
        return view('superadmin.reports.view-order-status')->with(['title' => 'Proforma Invoice', 'data' => $data, 'customer' => $customer, 'company' => $company]);
    }
    public function viewPaymentLedger()
    {
        $customer = Customer::all();
        return view('superadmin.reports.view-payment-ledger', compact('customer'));
    }
    public function store(Request $request)
    {
        // dd($request->type);
        if ($request->type == "total_orders_customer") {
            $request->validate([
                'customer_id'   =>  'required'
            ]);
            return redirect()->route('reports.total-customer-orders', $request->customer_id);
        } else if ($request->type == "perfoma_invoice") {
            $request->validate([
                'perfoma_invoice_no'   =>  'required'
            ]);
            return redirect()->route('reports.total-perfoma-invoice-orders', $request->perfoma_invoice_no);
        } else if ($request->type == "total_orders_company") {
            $request->validate([
                'company_id'   =>  'required'
            ]);
            return redirect()->route('reports.total-company-orders', $request->company_id);
        } else if ($request->type == "orders_shipped_customer") {
            $request->validate([
                'customer_id'   =>  'required'
            ]);
            return redirect()->route('reports.orders-shipped-customers', $request->customer_id);
        } else if ($request->type == "orders_shipped_company") {
            $request->validate([
                'company_id'   =>  'required'
            ]);
            return redirect()->route('reports.orders-shipped-company', $request->company_id);
        } else if ($request->type == "branded_products") {
            $request->validate([
                'branded_products'   =>  'required'
            ]);
            return redirect()->route('reports.orders-shipped-branded-products', $request->branded_products);
        } else if ($request->type == "order_status_customer") {
            $request->validate([
                'customer_id'   =>  'required'
            ]);
            return redirect()->route('reports.order-status-customer', $request->customer_id);
        } else if ($request->type == "order_status_company") {
            $request->validate([
                'company_id'   =>  'required'
            ]);
            return redirect()->route('reports.order-status-company', $request->company_id);
        } else if ($request->type == "payment_ledger_customer") {
            $request->validate([
                'customer_id'   =>  'required'
            ]);
            return redirect()->route('reports.payment-ledger-customer', $request->customer_id);
        } else if ($request->type == "customer_invoice") {
            $request->validate([
                'invoice'   =>  'required'
            ]);
            return redirect()->route('reports.custom-invoice', $request->invoice);
        } else if ($request->type == "bol_format") {
            $request->validate([
                'invoice'   =>  'required'
            ]);
            return redirect()->route('reports.bol-format-report', $request->invoice);
        }
    }
    public function totalCustomerOrders(Request $request)
    {
        // dd($request->customer_id);
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.customer_company_name, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                        join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                        join products on perfoma_invoice_details.product_id = products.id
                        join sizes on perfoma_invoice_details.size_id = sizes.id
                        join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.customer_id = {$request->customer_id} and perfoma_invoices.pi_date BETWEEN '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.customer_company_name, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                        join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                        join products on perfoma_invoice_details.product_id = products.id
                        join sizes on perfoma_invoice_details.size_id = sizes.id
                        join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.customer_id = {$request->customer_id} and perfoma_invoices.pi_date >= '{$from_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } else {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.customer_company_name, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                        join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                        join products on perfoma_invoice_details.product_id = products.id
                        join sizes on perfoma_invoice_details.size_id = sizes.id
                        join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.customer_id = {$request->customer_id} ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.total-orders-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('total-orders-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new TotalOrdersCustomerExport($data), 'total_orders_customer.xlsx');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function totalDateOrders(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'from_date' =>  'required',
                'to_date'   =>  'date|after:from_date',
                'export_type' => 'required'
            ]);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.customer_company_name, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                    join products on perfoma_invoice_details.product_id = products.id
                    join sizes on perfoma_invoice_details.size_id = sizes.id
                    join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.pi_date BETWEEN '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.id ASC;");
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.customer_company_name, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, perfoma_invoices.pi_date, customers.name customer_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                    join products on perfoma_invoice_details.product_id = products.id
                    join sizes on perfoma_invoice_details.size_id = sizes.id
                    join customers on perfoma_invoices.customer_id = customers.id where perfoma_invoices.pi_date >= '{$from_date}' ORDER BY perfoma_invoices.pi_date ASC;");
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.total-orders-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('total-orders-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new TotalOrdersDateExport($data), 'total_orders_date.xlsx');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function totalCompanyOrders(Request $request)
    {
        // dd($request->company_id);
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, companies.title, perfoma_invoices.pi_date, customers.customer_company_name customer_company_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                    join products on perfoma_invoice_details.product_id = products.id
                    join sizes on perfoma_invoice_details.size_id = sizes.id
                    join customers on perfoma_invoices.customer_id = customers.id
                    join companies on customers.company_id = companies.id where customers.company_id = {$request->company_id} and perfoma_invoices.pi_date BETWEEN '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, companies.title, perfoma_invoices.pi_date, customers.customer_company_name customer_company_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                    join products on perfoma_invoice_details.product_id = products.id
                    join sizes on perfoma_invoice_details.size_id = sizes.id
                    join customers on perfoma_invoices.customer_id = customers.id
                    join companies on customers.company_id = companies.id where customers.company_id = {$request->company_id} and perfoma_invoices.pi_date >= '{$from_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } else {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, perfoma_invoice_details.processed_at, perfoma_invoices.po_number, companies.title, perfoma_invoices.pi_date, customers.customer_company_name customer_company_name, perfoma_invoice_details.quantity quantity, perfoma_invoice_details.article_rate, perfoma_invoice_details.unit, perfoma_invoice_details.carton carton, quantity/carton no_of_carton, quantity*perfoma_invoice_details.article_rate total_price, perfoma_invoices.accepted_date, products.name product_name, customers.customer_code, sizes.name size_name, customers.currency,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
                    join products on perfoma_invoice_details.product_id = products.id
                    join sizes on perfoma_invoice_details.size_id = sizes.id
                    join customers on perfoma_invoices.customer_id = customers.id
                    join companies on customers.company_id = companies.id where customers.company_id = {$request->company_id} ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.total-orders-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('total-orders-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new TotalOrdersCompanyExport($data), 'total_orders_company.xlsx');
            }
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrdersShippedCustomers(Request $request)
    {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select invoice_creations.invoice_no, customers.name as customer_name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date BETWEEN '{$from_date}' AND '{$to_date}' AND customers.id = {$request->customer_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select invoice_creations.invoice_no, customers.name as customer_name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date >= '{$from_date}' AND customers.id = {$request->customer_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            } else {
                $data = DB::select("select invoice_creations.invoice_no, customers.name as customer_name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND customers.id = {$request->customer_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.orders-shipped-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('orders-shipped-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new OrderShippedCustomerExport($data), 'orders-shipped-customer.xlsx');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrdersShippedCompany(Request $request)
    {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select invoice_creations.invoice_no, companies.title, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id
                    JOIN companies on customers.company_id = companies.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date BETWEEN '{$from_date}' AND '{$to_date}' AND customers.company_id = {$request->company_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select invoice_creations.invoice_no, companies.title, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id
                    JOIN companies on customers.company_id = companies.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date >= '{$from_date}' AND customers.company_id = {$request->company_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            } else {
                $data = DB::select("select invoice_creations.invoice_no, companies.title, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id
                    JOIN companies on customers.company_id = companies.id where invoice_creations.awb_date IS NOT NULL AND customers.company_id = {$request->company_id} ORDER BY invoice_creations.awb_date ASC");
                // dd($data);
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.orders-shipped-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('orders-shipped-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new OrderShippedCompanyExport($data), 'orders-shipped-company.xlsx');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrdersShippedBrandedProducts($id)
    {
        try {
            if (ob_get_contents()) ob_end_clean();
            $data = DB::select("select invoice_creations.invoice_no, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
            join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
            join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
            join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
            JOIN customers on invoice_creations.customer_id = customers.id
            JOIN products on perfoma_invoice_details.product_id = products.id
            JOIN brands on products.brand_id = brands.id
            JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND products.brand_id = '{$id}' ORDER BY invoice_creations.awb_date ASC");
            $pdf = PDF::loadview('superadmin.reports.orders-shipped-report', ['data' => $data,]);
            return $pdf->stream('orders-shipped-report.pdf');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrdersShippedDateReport(Request $request)
    {
        try {
            $request->validate([
                'from_date' =>  'required',
                'to_date'   =>  'date|after:from_date',
                'export_type' => 'required'
            ]);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            // dd($to_date);
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select invoice_creations.invoice_no, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date BETWEEN '{$from_date}' AND '{$to_date}' ORDER BY invoice_creations.awb_date ASC");
            } elseif ($from_date != null && $to_date == null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select invoice_creations.invoice_no, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, sizes.name size, products.name product_name, invoice_creation_details.quantity, perfoma_invoice_details.unit, customers.currency, invoice_creation_details.quantity*perfoma_invoice_details.article_rate total from invoice_creations
                    join invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    join perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                    join perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where invoice_creations.awb_date IS NOT NULL AND invoice_creations.awb_date >= '{$from_date}' ORDER BY invoice_creations.awb_date ASC");
            }
            if ($request->export_type == 'excel') {
                return Excel::download(new OrderShippedDateExport($data), 'orders_shipped.xlsx');
            } elseif ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.orders-shipped-report', ['data' => $data,]);
                return $pdf->stream('orders-shipped-report.pdf');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrderStatusCustomer(Request $request)
    {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null && $request->customer_id != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select customers.name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                        WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                        ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where perfoma_invoices.customer_id = {$request->customer_id} and perfoma_invoices.pi_date between '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.pi_date ASC");
                // dd($data);
            } else if ($from_date != null && $to_date != null && $request->customer_id == null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select customers.name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                        WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                        ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where perfoma_invoices.customer_id in (select id from customers) and perfoma_invoices.pi_date between '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.pi_date ASC");
                // dd($data);
            } elseif ($from_date != null && $to_date == null && $request->customer_id != null) {
                $data = DB::select("select customers.name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                        WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                        ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where perfoma_invoices.customer_id = {$request->customer_id} and perfoma_invoices.pi_date >= '{$from_date}' ORDER BY perfoma_invoices.pi_date ASC");
                // dd($data);
            } else {
                $data = DB::select("select customers.name, customers.customer_company_name, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                        WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                        ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where perfoma_invoices.customer_id = {$request->customer_id} ORDER BY perfoma_invoices.pi_date ASC");
                // dd($data);
            }
            if ($request->export_type == 'excel') {
                return Excel::download(new OrderStatusCustomerExport($data), 'orders_shipped.xlsx');
            } elseif ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.order-status-report', ['data' => $data,]);
                return $pdf->stream('order-status-report.pdf');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function OrderStatusCompany(Request $request)
    {
        $customer = Customer::all();
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.id as customer_id, companies.title, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                    WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                    ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN companies on customers.company_id = companies.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where customers.company_id = {$request->company_id} and perfoma_invoices.pi_date between '{$from_date}' AND '{$to_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.id as customer_id, companies.title, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                    CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                    WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                    ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN companies on customers.company_id = companies.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where customers.company_id = {$request->company_id} and perfoma_invoices.pi_date >= '{$from_date}' ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            } else {
                $data = DB::select("select perfoma_invoices.perfoma_invoice_no_local, customers.id as customer_id, companies.title, perfoma_invoices.po_number, perfoma_invoices.accepted_date, sizes.name as size_name, products.name as product_name, perfoma_invoice_details.quantity order_quantity, perfoma_invoice_details.unit,
                CASE WHEN perfoma_invoice_details.unit = 8 THEN perfoma_invoice_details.quantity*12
                        WHEN perfoma_invoice_details.unit = 7 THEN perfoma_invoice_details.quantity/2
                        ELSE perfoma_invoice_details.quantity*1
                    END as quantity_pairs, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12
                    WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2
                    ELSE products.individual_packing*1
                    END as pack, (select CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12)
                    WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2)
                    ELSE sum(invoice_creation_details.quantity*1)
                    END FROM invoice_creation_details where invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id and invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id) as shipped, perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm, (quantity/carton)*(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as total_cbm FROM perfoma_invoices
                    JOIN perfoma_invoice_details on perfoma_invoice_details.perfoma_invoice_id = perfoma_invoices.id
                    JOIN customers on perfoma_invoices.customer_id = customers.id
                    JOIN companies on customers.company_id = companies.id
                    JOIN products on perfoma_invoice_details.product_id = products.id
                    JOIN sizes on perfoma_invoice_details.size_id = sizes.id where customers.company_id = {$request->company_id} ORDER BY perfoma_invoices.pi_date ASC;");
                // dd($data);
            }
            // foreach ($data as $it) {
            //     $customers = Customer::where('id', $it->customer_id)->get();
            //     // dd($customer);
            // }
            // $customer = $customers;
            if ($request->export_type == 'excel') {
                return Excel::download(new OrderStatusCompanyExport($data, $customer), 'orders_shipped.xlsx');
            } elseif ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.order-status-report', ['data' => $data, 'customer' => $customer]);
                return $pdf->stream('order-status-report.pdf');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function shipmentPlanView()
    {
        $companies = Company::get();
        return view('superadmin.reports.shipment_plan_view', compact('companies'));
    }
    public function shipmentPlanReport(Request $request)
    {
        try {
            $request->validate([
                'customer_id' => 'required',
                'perfoma_invoice_id' => 'required|array|min:1',
                'perfoma_invoice_detail_id' => 'required|array|min:1',
                'export_type' => 'required'
            ]);
            $customer_id = $request->customer_id;
            $pi_details_id = implode(',', $request->perfoma_invoice_detail_id);
            $quantities = [];
            foreach ($request->perfoma_invoice_detail_id as $key => $value) {
                $quantities[$value] = $request->quantity[$key] == '' ? 0 : $request->quantity[$key];
            }
            ksort($quantities);
            $data = DB::select("select perfoma_invoice_details.id,customers.name as customer_name,customers.customer_company_name,perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number,sizes.name size_name,products.name product_name,perfoma_invoice_details.unit, CASE WHEN perfoma_invoice_details.unit = 8 THEN products.individual_packing*12 WHEN perfoma_invoice_details.unit = 7 THEN products.individual_packing/2 ELSE products.individual_packing*1 END as pack,perfoma_invoice_details.carton,(select product_sizes.cbm FROM product_sizes where product_sizes.size_id = perfoma_invoice_details.size_id and product_sizes.product_id = products.id) as cbm FROM perfoma_invoices
            join perfoma_invoice_details on perfoma_invoices.id = perfoma_invoice_details.perfoma_invoice_id
            join products on perfoma_invoice_details.product_id = products.id
            join sizes on perfoma_invoice_details.size_id = sizes.id
            join customers on perfoma_invoices.customer_id = customers.id
            where perfoma_invoices.customer_id = {$customer_id} and perfoma_invoice_details.id in ({$pi_details_id}) order by perfoma_invoice_details.id");
            // dd($data);
            if ($request->export_type == 'excel') {
                return Excel::download(new OrderShippedPlanExport($data, $quantities), 'shipment_plan.xlsx');
            } elseif ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.shipment_plan_report', ['data' => $data, 'quantities' => $quantities]);
                return $pdf->stream('orders-shipped-report.pdf');
            }
            $pdf = PDF::loadview('superadmin.reports.shipment_plan_report', ['data' => $data, 'quantities' => $quantities]);
            return $pdf->stream('orders-shipped-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function PaymentLedgerCustomer(Request $request)
    {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("SELECT customers.name, customers.customer_company_name, invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
                    JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id WHERE invoice_creations.awb_date BETWEEN '{$from_date}' AND '{$to_date}' AND customers.id = {$request->customer_id} and invoice_creations.awb_date IS NOT NULL GROUP BY invoice_creations.invoice_no;");
                // dd($data);
            } elseif ($from_date != null && $to_date == null) {
                $data = DB::select("SELECT customers.name, customers.customer_company_name, invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
                    JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id WHERE invoice_creations.awb_date >= '{$from_date}' AND customers.id = {$request->customer_id} and invoice_creations.awb_date IS NOT NULL GROUP BY invoice_creations.invoice_no;");
                // dd($data);
            } else {
                $data = DB::select("SELECT customers.name, customers.customer_company_name, invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
                    JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id WHERE customers.id = {$request->customer_id} and invoice_creations.awb_date IS NOT NULL GROUP BY invoice_creations.invoice_no;");
                // dd($data);
            }
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.payment-ledger-report', ['data' => $data,])->setPaper('a4', 'landscape');
                return $pdf->stream('payment-ledger-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new PaymentLedgerExport($data), 'payment-ledger-customer.xlsx');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function PaymentLedgerDateReport(Request $request)
    {
        try {
            $request->validate([
                'from_date' =>  'required',
                'to_date'   =>  'date|after:from_date',
                'export_type' => 'required'
            ]);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            // dd($to_date);
            if ($from_date != null && $to_date != null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("SELECT invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
                    JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id WHERE invoice_creations.awb_date BETWEEN '{$from_date}' AND '{$to_date}' GROUP BY invoice_creations.invoice_no;");
            } elseif ($from_date != null && $to_date == null) {
                if (ob_get_contents()) ob_end_clean();
                $data = DB::select("SELECT invoice_creations.invoice_no, invoice_creations.awb_date, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as amount, customers.currency, (SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY)) as due_date, invoice_creations.payment_date as payment_received, IF(invoice_creations.payment_date IS NOT NULL, 0,sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate)) as balance from invoice_creations
                    JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                    JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                    JOIN customers on invoice_creations.customer_id = customers.id WHERE invoice_creations.awb_date >= '{$from_date}' GROUP BY invoice_creations.invoice_no;");
            }
            if ($request->export_type == 'excel') {
                return Excel::download(new PaymentLedgerDateExport($data), 'payment-ledger.xlsx');
            } elseif ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.payment-ledger-report', ['data' => $data,]);
                return $pdf->stream('payment-ledger-report.pdf');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }

    public function viewReceivableReport()
    {
        $customer = Customer::all();
        $company = Company::all();
        return view('superadmin.reports.view-receivable-report', \compact('customer', 'company'));
    }

    public function receivableReport(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'USD'   => 'required',
                    'EUR'   => 'required',
                    'CAD'   => 'required',
                ],
                [
                    'USD.required'   => 'USD field is required',
                    'EUR.required'   => 'EUR field is required',
                    'CAD.required'   => 'CAD field is required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput($request->input())->withErrors($validator)->with('msg', 'Please insert all currency!');
            }
            if ($request->type == 'receivable_customer') {
                $request->validate([
                    'customer_id'   => 'required'
                ]);
                $detail = $this->receivableReportQurey($request->type, $request->customer_id, $request->date_from, $request->date_to);
            } elseif ($request->type == 'receivable_company') {
                $request->validate([
                    'company_id'    => 'required'
                ]);
                $detail = $this->receivableReportQurey($request->type, $request->company_id, $request->date_from, $request->date_to);
            } elseif ($request->type == 'receivable_date_range') {
                $request->validate([
                    'date_from'     => 'required',
                    'date_to'       => 'required'
                ]);
                $detail = $this->receivableReportQurey($request->type, $request->date_from, $request->date_to);
            }

            $request['PKR'] = 1;
            $request_data = $request->all();
            $data = collect($detail);

            if ($request->report == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.receivable-report', ['data' => $data, 'request' => $request_data]);
                return $pdf->stream('receivable-report.pdf');
            } elseif ($request->report == 'excel') {
                return Excel::download(new ReceivableReport($data, $request_data), 'receivable_report.xlsx');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }

    public function receivableReportQurey($type, $value1 = null, $value2 = null, $value3 = null)
    {
        try {
            $filter = '';
            if ($type == 'receivable_customer') {
                if ($value2 != null && $value3 != null) {
                    $filter = ' AND invoice_creations.customer_id = ' . $value1 . ' AND invoice_creations.awb_date BETWEEN "' . $value2 . '" AND "' . $value3 . '"';
                } elseif ($value2 != null && $value3 == null) {
                    $filter = ' AND invoice_creations.customer_id = ' . $value1 . ' AND invoice_creations.awb_date >= "' . $value2 . '"';
                } else {
                    $filter = ' AND invoice_creations.customer_id = ' . $value1;
                }
            } elseif ($type == 'receivable_company') {
                if ($value2 != null && $value3 != null) {
                    $filter = ' AND customers.company_id = ' . $value1 . ' AND invoice_creations.awb_date BETWEEN "' . $value2 . '" AND "' . $value3 . '"';
                } elseif ($value2 != null && $value3 == null) {
                    $filter = ' AND customers.company_id = ' . $value1 . ' AND invoice_creations.awb_date >= "' . $value2 . '"';
                } else {
                    $filter = ' AND customers.company_id = ' . $value1;
                }
            } elseif ($type == 'receivable_date_range') {
                $filter = ' AND invoice_creations.awb_date BETWEEN "' . $value1 . '" AND "' . $value2 . '"';
            }

            $query = 'select companies.title, customers.customer_company_name, invoice_creations.invoice_no, invoice_creations.awb_date, customers.currency, sum(invoice_creation_details.quantity*perfoma_invoice_details.article_rate) as total_amount,(SELECT DATE_ADD(invoice_creations.awb_date, INTERVAL customers.credit_days DAY))  as due_date, customers.company_id from invoice_creations
            JOIN customers on invoice_creations.customer_id = customers.id
            JOIN companies on customers.company_id = companies.id
            JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
            JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
            WHERE invoice_creations.payment_date IS NULL and invoice_creations.awb_date IS NOT NULL
            ' . $filter . '
            GROUP BY invoice_creations.invoice_no';
            $data = DB::select($query);

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }

    public function ViewCustomInvoice()
    {
        $invoice = InvoiceCreation::all();
        return view('superadmin.reports.view-custom-invoice', compact('invoice'));
    }

    public function CustomInvoice($id)
    {
        try {
            if (ob_get_contents()) ob_end_clean();
            if (isset($id)) {
                $data = DB::select("SELECT invoice_creations.invoice_no as invoice, countries.name as country_name, customers.customer_company_name, customers.bill_to, invoice_creations.description as invoice_for, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, invoice_creations.shipped_per as shipped_per, customers.currency, invoice_creations.ship_to, invoice_creations.form_no, customers.country_id as country, companies.title, companies.address, companies.prefix as markd, sum(invoice_creation_details.quantity) * sum(invoice_creation_details.quantity) / sum(perfoma_invoice_details.article_rate) as amount, (SELECT CASE WHEN perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity*12) WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity/2) ELSE sum(invoice_creation_details.quantity * 1) END from invoice_creation_details where invoice_creation_details.invoice_creation_id = invoice_creations.id) as quantity, sum(product_sizes.cbm) as cbm, perfoma_invoices.shipping_method, sum(product_sizes.net_weight_per_carton) as net_weight_per_carton, sum(product_sizes.gross_weight_per_carton) as gross_weight_per_carton, invoice_creations.form_date, invoice_creations.invoice_creation_date, perfoma_invoices.pi_date from invoice_creations
                JOIN customers on invoice_creations.customer_id = customers.id
                JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                JOIN perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                JOIN countries on customers.country_id = countries.id
                JOIN companies on customers.company_id = companies.id
                JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                JOIN product_sizes on product_sizes.product_id = perfoma_invoice_details.product_id where invoice_creations.id = {$id} GROUP BY invoice_creations.invoice_no;");

                $packing_list_details = DB::select("SELECT sum(packing_list_details.net_weight) as net_weight, sum(packing_list_details.gross_weight) as gross_weight, sum(packing_list_details.cbm) as cbm from packing_list_details
                JOIN packing_lists on packing_list_details.packing_list_id = packing_lists.id
                JOIN invoice_creations on packing_lists.invoice_creation_id = invoice_creations.id where invoice_creations.id = {$id};");

                $amount = DB::select("SELECT invoice_creation_details.quantity, sum(perfoma_invoice_details.article_rate) as article_rate, sum(invoice_creation_details.quantity * perfoma_invoice_details.article_rate) as amount from invoice_creation_details
                JOIN invoice_creations on invoice_creation_details.invoice_creation_id = invoice_creations.id
                JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id where invoice_creations.id = {$id};");
                // dd($data);
                $pdf = PDF::loadview('superadmin.reports.custom-invoice-report', ['data' => $data, 'packing_list_details' => $packing_list_details, 'amount' => $amount]);
                return $pdf->stream('custom-invoice-report.pdf');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    public function exportCustomInvoice($id)
    {
        return Excel::download(new CustomInvoiceExport($id), 'custom-invoice.xlsx');
    }

    public function ViewPackingList()
    {
        $invoice = InvoiceCreation::all();
        return view('superadmin.reports.view-packing-list', compact('invoice'));
    }

    public function PackingList(Request $request)
    {
        try {
            $request->validate([
                'invoice'       =>  'required',
                'export_type'   =>  'required'
            ]);
            $invoice_creation_detail = InvoiceCreationDetail::with(['perfomaInvoice', 'perfomaInvoiceDetail'])->where('invoice_creation_id', $request->invoice)->orderBy('perfoma_invoice_id')->get();
            $carton_count = 0;
            // dd($invoice_creation_detail);
            foreach ($invoice_creation_detail->sortBy('perfoma_invoice_detail_id') as $key => $value) {
                @$ctn = @$value->quantity / @$value->perfomaInvoiceDetail->product->individual_packing;
                $temp_product_detail = @$value->perfomaInvoiceDetail->product->productsize;
                // dd($value);
                $temp_product_size = $temp_product_detail->where('size_id', $value->perfomaInvoiceDetail->size_id)->first();
                @$cbm = $ctn * @$temp_product_size->cbm;
                @$net_weight = $ctn * @$temp_product_size->net_weight_per_carton;
                @$gross_weight = $ctn * @$temp_product_size->gross_weight_per_carton;
                $table_detail[] = [
                    'po_no'                  =>  @$value->perfomaInvoice->po_number,
                    'article_no'             =>  @$value->perfomaInvoiceDetail->product->name,
                    'size'                   =>  @$value->perfomaInvoiceDetail->size->name,
                    'quantity'               =>  @$value->quantity,
                    'unit_of_measurement'    =>  @measurementUnit()[@$value->perfomaInvoiceDetail->product->unit],
                    'individual_packing'     =>  @number_format($value->perfomaInvoiceDetail->product->individual_packing),
                    'carton'                 =>  @$ctn,
                    'ind_cbm'                =>  @number_format($cbm, 2),
                    'net_weight'             =>  @number_format($net_weight, 2),
                    'gross_weight'           =>  @number_format($gross_weight, 2),
                    'carton_serial'          =>  sprintf("%03d", ($carton_count + 1)) . " TO " . sprintf("%03d", ($carton_count + $ctn)),
                ];
                $carton_count += $ctn;
            }
            $total_quantity = 0;
            foreach ($invoice_creation_detail->sortBy('perfoma_invoice_detail_id') as $key => $value) {
                if (@measurementUnit()[@$value->perfomaInvoiceDetail->product->unit] == 'DZN') {
                    $total_quantity = $total_quantity + ($value->quantity * 12);
                } elseif (@measurementUnit()[@$value->perfomaInvoiceDetail->product->unit] == 'PCS') {
                    $total_quantity = $total_quantity + ($value->quantity / 2);
                } else {
                    $total_quantity = $total_quantity + $value->quantity;
                }
            }
            // dd($total_quantity);
            if (ob_get_contents()) ob_end_clean();
            $data = DB::select("SELECT invoice_creations.invoice_no as invoice, customers.customer_company_name, customers.bill_to, countries.name as country_name, invoice_creations.description as invoice_for, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, invoice_creations.shipped_per as shipped_per, invoice_creations.ship_to, invoice_creations.form_no, customers.country_id as country, companies.title, companies.address, companies.prefix as markd, sum(product_sizes.cbm) as cbm, sum(product_sizes.net_weight_per_carton) as net_weight_per_carton, sum(product_sizes.gross_weight_per_carton) as gross_weight_per_carton, invoice_creations.form_date, invoice_creations.invoice_creation_date, perfoma_invoices.pi_date from invoice_creations
                JOIN customers on invoice_creations.customer_id = customers.id
                JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                JOIN perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                JOIN countries on customers.country_id = countries.id
                JOIN companies on customers.company_id = companies.id
                JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                JOIN product_sizes on product_sizes.product_id = perfoma_invoice_details.product_id where invoice_creations.id = {$request->invoice} GROUP BY invoice_creations.invoice_no;");
            // dd($data, $table_detail);

            $packing_list_details = DB::select("SELECT sum(packing_list_details.net_weight) as net_weight, sum(packing_list_details.gross_weight) as gross_weight, sum(packing_list_details.cbm) as cbm from packing_list_details
                JOIN packing_lists on packing_list_details.packing_list_id = packing_lists.id
                JOIN invoice_creations on packing_lists.invoice_creation_id = invoice_creations.id where invoice_creations.id = {$request->invoice};");
            if ($request->export_type == 'pdf') {
                $pdf = PDF::loadview('superadmin.reports.packing-list-report', ['data' => $data, 'packing_list_details' => $packing_list_details, "table_detail" => $table_detail, 'total_quantity' => $total_quantity]);
                return $pdf->stream('packing-list-report.pdf');
            } elseif ($request->export_type == 'excel') {
                return Excel::download(new InvoicePackingListExport($data, $table_detail), 'packing-list.xlsx');
            }
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }

    public function ViewBolFormat()
    {
        $invoice = InvoiceCreation::all();
        return view('superadmin.reports.view-bol-format', compact('invoice'));
    }

    public function BolFormat($id)
    {
        try {
            if (ob_get_contents()) ob_end_clean();
            if (isset($id)) {
                $data = DB::select("SELECT invoice_creations.invoice_no as invoice, countries.name as country_name, customers.bill_to, sum(invoice_creation_details.quantity) as quantity, sum(perfoma_invoice_details.carton) as carton, perfoma_invoices.perfoma_invoice_no_local, perfoma_invoices.po_number, invoice_creations.form_no, companies.title, companies.address as company_address, company_details.branch_name, company_details.branch_address, customers.customer_company_name, customers.address, companies.prefix as markd, sum(product_sizes.cbm) as cbm, sum(product_sizes.net_weight_per_carton) as net_weight_per_carton, sum(product_sizes.gross_weight_per_carton) as gross_weight_per_carton, invoice_creations.form_date,
                (CASE WHEN perfoma_invoice_details.unit = 7 THEN invoice_creation_details.quantity / 2
                     WHEN perfoma_invoice_details.unit = 8 THEN invoice_creation_details.quantity * 12
                        END) as converted_quantity from invoice_creations
                JOIN customers on invoice_creations.customer_id = customers.id
                JOIN invoice_creation_details on invoice_creation_details.invoice_creation_id = invoice_creations.id
                JOIN perfoma_invoices on invoice_creation_details.perfoma_invoice_id = perfoma_invoices.id
                JOIN countries on customers.country_id = countries.id
                JOIN companies on customers.company_id = companies.id
                JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                JOIN company_details on invoice_creations.company_detail_id = company_details.id
                JOIN product_sizes on product_sizes.product_id = perfoma_invoice_details.product_id where invoice_creations.id = {$id} GROUP BY invoice_creations.invoice_no;");
                // dd($data);

                $packing_list_details = DB::select("SELECT sum(packing_list_details.carton) as carton, sum(packing_list_details.net_weight) as net_weight, sum(packing_list_details.gross_weight) as gross_weight, sum(packing_list_details.cbm) as cbm from packing_list_details
                JOIN packing_lists on packing_list_details.packing_list_id = packing_lists.id
                JOIN invoice_creations on packing_lists.invoice_creation_id = invoice_creations.id where invoice_creations.id = {$id};");

                $quantity = DB::select("SELECT CASE when perfoma_invoice_details.unit = 8 THEN sum(invoice_creation_details.quantity) * 12 WHEN perfoma_invoice_details.unit = 7 THEN sum(invoice_creation_details.quantity) / 2 ELSE sum(invoice_creation_details.quantity) * 1 END as quantity from invoice_creation_details
                JOIN perfoma_invoice_details on invoice_creation_details.perfoma_invoice_detail_id = perfoma_invoice_details.id
                JOIN invoice_creations on invoice_creation_details.invoice_creation_id = invoice_creations.id WHERE invoice_creations.id = {$id};");

                $pdf = PDF::loadview('superadmin.reports.bol-format-report', ['data' => $data, 'packing_list_details' => $packing_list_details, 'quantity' => $quantity]);
                return $pdf->stream('bol-format-report.pdf');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data not found!');
        }
    }
    // public function exportPaymentLedgerCustomerExcel($id)
    // {
    //     return Excel::download(new PaymentLedgerExport($id), 'payment_ledger_customer.xlsx');
    // }
    // public function exportOrderStatusCustomerExcel($id)
    // {
    //     return Excel::download(new OrderStatusCustomerExport($id), 'order_status_customer.xlsx');
    // }
    // public function exportOrderStatusCompanyExcel($id)
    // {
    //     return Excel::download(new OrderStatusCompanyExport($id), 'order_status_company.xlsx');
    // }
    // public function exportTotalOrdersCustomerExcel($id)
    // {
    //     return Excel::download(new TotalOrdersCustomerExport($id), 'total_orders_customer.xlsx');
    // }
    // public function exportTotalOrdersCompanyExcel($id)
    // {
    //     return Excel::download(new TotalOrdersCompanyExport($id), 'total_orders_company.xlsx');
    // }
    // public function exportOrderShippedCompanyExcel($id)
    // {
    //     return Excel::download(new OrderShippedCustomerExport($id), 'order_shipped_company.xlsx');
    // }
    public function exportOrderShippedProductBrandExcel($id)
    {
        return Excel::download(new OrdersShippedBrandProductsExport($id), 'order_shipped_branded_products.xlsx');
    }
    // public function exportOrdersShippedCompanyExcel($id)
    // {
    //     return Excel::download(new OrderShippedCompanyExport($id), 'orders_shipped_company.xlsx');
    // }
}