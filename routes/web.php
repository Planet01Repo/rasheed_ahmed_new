<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/login', function () {
    return view('auth/login');
});
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();
Route::group(['middleware' => ['role:SuperAdmin', 'auth']], function () {
    Route::get('/', 'SuperAdmin\CompanyController@index')->name('home');
    Route::get('add-role', 'SuperAdmin\RoleController@add_role')->name('add.role');
    Route::get('assign-role', 'SuperAdmin\RoleController@assign_role')->name('assign.role');

    //company
    Route::group(['prefix' => 'company'], function () {
        Route::get('add/{id?}', 'SuperAdmin\CompanyController@add')->name('company.add');
        Route::get('company-bank-details/{id}', 'SuperAdmin\CompanyDetailController@index')->name('companydetails.index');
        Route::post('post', 'SuperAdmin\CompanyController@post')->name('company.post');
        Route::get('/', 'SuperAdmin\CompanyController@index')->name('company.view');
        Route::post('/delete/image/}', 'SuperAdmin\CompanyController@delete_image_logo')->name('company.image.delete.logo');
        Route::post('/delete/image/header/}', 'SuperAdmin\CompanyController@delete_image_header')->name('company.image.delete.header');
        Route::post('/delete/image/footer/}', 'SuperAdmin\CompanyController@delete_image_footer')->name('company.image.delete.footer');
    });

    //customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('add/{id?}', 'SuperAdmin\CustomerController@add')->name('customer.add');
        Route::post('post', 'SuperAdmin\CustomerController@post')->name('customer.post');
        Route::get('/', 'SuperAdmin\CustomerController@index')->name('customer.view');
        Route::get('/detail/{id}', 'SuperAdmin\CustomerController@detail')->name('customer.detail');
    });

    //supplier
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('add/{id?}', 'SuperAdmin\SupplierController@add')->name('supplier.add');
        Route::post('post', 'SuperAdmin\SupplierController@post')->name('supplier.post');
        Route::get('/', 'SuperAdmin\SupplierController@index')->name('supplier.view');
        Route::get('/detail/{id}', 'SuperAdmin\SupplierController@detail')->name('supplier.detail');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('add/{id?}', 'SuperAdmin\ProductController@add')->name('product.add');
        Route::post('post', 'SuperAdmin\ProductController@post')->name('product.post');
        Route::get('/', 'SuperAdmin\ProductController@index')->name('product.view');
        Route::get('/delete/{id}', 'SuperAdmin\ProductController@delete')->name('product.delete');
        Route::get('/detail/{id}', 'SuperAdmin\ProductController@detail')->name('product.detail');
        Route::post('/delete/image/}', 'SuperAdmin\ProductController@delete_image')->name('product.image.delete');
    });

    //material
    Route::group(['prefix' => 'material'], function () {
        Route::get('add/{id?}', 'SuperAdmin\MaterialController@add')->name('material.add');
        Route::post('post', 'SuperAdmin\MaterialController@post')->name('material.post');
        Route::get('/', 'SuperAdmin\MaterialController@index')->name('material.view');
    });

    //PO_material
    Route::group(['prefix' => 'po_material'], function () {
        Route::get('add/{id?}', 'SuperAdmin\PoMaterialController@add')->name('po_material.add');
        Route::post('post', 'SuperAdmin\PoMaterialController@post')->name('po_material.post');
        Route::get('/', 'SuperAdmin\PoMaterialController@index')->name('po_material.view');
    });

    //size
    Route::group(['prefix' => 'size'], function () {
        Route::get('add/{id?}', 'SuperAdmin\SizeController@add')->name('size.add');
        Route::post('post', 'SuperAdmin\SizeController@post')->name('size.post');
        Route::get('/', 'SuperAdmin\SizeController@index')->name('size.view');
    });

    //carton
    Route::group(['prefix' => 'carton'], function () {
        Route::get('add/{id?}', 'SuperAdmin\CartonController@add')->name('carton.add');
        Route::post('post', 'SuperAdmin\CartonController@post')->name('carton.post');
        Route::get('/', 'SuperAdmin\CartonController@index')->name('carton.view');
    });

    //perfoma Invoice
    Route::group(['prefix' => 'perfoma_invoice'], function () {
        Route::get('add/{id?}', 'SuperAdmin\PerfomaInvoiceController@add')->name('perfoma_invoice.add');
        Route::post('post', 'SuperAdmin\PerfomaInvoiceController@post')->name('perfoma_invoice.post');
        Route::get('/', 'SuperAdmin\PerfomaInvoiceController@index')->name('perfoma_invoice.view');
        Route::get('/delete/{id}', 'SuperAdmin\PerfomaInvoiceController@delete')->name('perfoma_invoice.delete');
        Route::get('/detail/{id}', 'SuperAdmin\PerfomaInvoiceController@detail')->name('perfoma_invoice.detail');
        Route::get('/pdf_report/{id}', 'SuperAdmin\PerfomaInvoiceController@pdf_report')->name('perfoma_invoice.pdf');
        Route::post('/customer_product', 'SuperAdmin\PerfomaInvoiceController@customer_product')->name('perfoma_invoice.customer_product');
    });

    //packing list
    Route::group(['prefix' => 'packing_list'], function () {
        Route::get('add/{id?}', 'SuperAdmin\PackingListController@add')->name('packing_list.add');
        Route::post('post', 'SuperAdmin\PackingListController@post')->name('packing_list.post');
        Route::get('/', 'SuperAdmin\PackingListController@index')->name('packing_list.view');
        Route::get('/delete/{id}', 'SuperAdmin\PackingListController@delete')->name('packing_list.delete');
        Route::get('/detail/{id}', 'SuperAdmin\PackingListController@detail')->name('packing_list.detail');
        Route::get('/pdf_report/{id}', 'SuperAdmin\PackingListController@pdf_report')->name('packing_list.pdf');
        Route::post('/customer_product', 'SuperAdmin\PackingListController@customer_product')->name('packing_list.customer_product');

        Route::post('/getInvoiceCreationByCustomerId', 'SuperAdmin\PackingListController@getInvoiceCreationByCustomerId')->name('packing_list.invoiceCreationByCustomerId');
        Route::post('/getInvoiceCreationDetailsByInvoiceCreationId', 'SuperAdmin\PackingListController@getInvoiceCreationDetailsByInvoiceCreationId')->name('getInvoiceCreationDetailsByInvoiceCreationId');
    });

    //purchase order
    Route::group(['prefix' => 'purchase_order'], function () {
        Route::get('add/{id?}', 'SuperAdmin\PurchaseOrderController@add')->name('purchase_order.add');
        Route::post('post', 'SuperAdmin\PurchaseOrderController@post')->name('purchase_order.post');
        Route::get('/', 'SuperAdmin\PurchaseOrderController@index')->name('purchase_order.view');
        Route::get('/delete/{id}', 'SuperAdmin\PurchaseOrderController@delete')->name('purchase_order.delete');
        Route::get('/detail/{id}', 'SuperAdmin\PurchaseOrderController@detail')->name('purchase_order.detail');
        Route::get('/pdf_report/{id}', 'SuperAdmin\PurchaseOrderController@pdf_report')->name('purchase_order.pdf');
        Route::post('/customer_product', 'SuperAdmin\PurchaseOrderController@customer_product')->name('purchase_order.customer_product');
    });

    //Delete All
    Route::group(['prefix' => 'delete'], function () {
        Route::get('/', 'SuperAdmin\DeleteAllController@index')->name('delete.view');
        Route::post('post', 'SuperAdmin\DeleteAllController@post')->name('delete.post');
    });


    Route::resource('brand', 'SuperAdmin\BrandController');


    Route::get('/change-password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('change.password.form');
    Route::post('/change-password', 'Auth\ChangePasswordController@changePassword')->name('change.password');


    Route::post('getPerfomaInvoiceByCustomerId', 'SuperAdmin\InvoiceCreationController@getPerfomaInvoiceByCustomerId')->name('getPerfomaInvoiceByCustomerId');
    Route::post('getPerfomaInvoiceDetailsByPerfomaInvoice', 'SuperAdmin\InvoiceCreationController@getPerfomaInvoiceDetailsByPerfomaInvoice')->name('getPerfomaInvoiceDetailsByPerfomaInvoice');
    Route::post('getPerfomaInvoiceDetails', 'SuperAdmin\InvoiceCreationController@getPerfomaInvoiceDetails')->name('getPerfomaInvoiceDetails');

    Route::post('inwords/', 'SuperAdmin\InvoiceCreationController@inwords')->name('inwords');
    Route::get('invoice_creation/pdf_report/{id}', 'SuperAdmin\InvoiceCreationController@pdfReport')->name('invoice_creation.pdf');
    Route::get('invoice_creation/exportExcel/{id}', 'SuperAdmin\InvoiceCreationController@exportExcel')->name('invoice_creation.excel');
    Route::get('packing_list/exportExcel/{id}', 'SuperAdmin\PackingListController@exportExcel')->name('packing_list.excel');
    Route::get('getCustomerCurrency/{id}', 'SuperAdmin\InvoiceCreationController@getCustomerCurrency')->name('getCurrencyByCustomerId');
    Route::get('getBankDetails/{id}', 'SuperAdmin\InvoiceCreationController@getBankDetails')->name('getBankDetailsByCustomerId');
    Route::get('getBankDetailsFromCompany/{id}', 'SuperAdmin\InvoiceCreationController@getBankDetailsFromCompany')->name('getBankDetailsFromCompany');
    Route::get('editBankDetails/{id}', 'SuperAdmin\InvoiceCreationController@editBankDetails')->name('editBankDetailsByCustomerId');
    Route::get('getShipTo/{id}', 'SuperAdmin\InvoiceCreationController@getShipTo')->name('getShipToByCustomerId');
    Route::get('editShipTo/{id}', 'SuperAdmin\InvoiceCreationController@editShipTo')->name('editShipToByCustomerId');
    Route::post('addBankDetails', 'SuperAdmin\CompanyDetailController@saveBankDetails')->name('company.saveBankDetails');
    Route::get('editBankDetails/{id}', 'SuperAdmin\CompanyDetailController@editBankDetails')->name('company.editBankDetails');
    Route::post('updateBankDetails', 'SuperAdmin\CompanyDetailController@updateBankDetails')->name('company.updateBankDetails');
    Route::get('/deleteBankDetails/{id}', 'SuperAdmin\CompanyDetailController@deleteBankDetails')->name('company-bankDetails.destroy');
    Route::get('invoice_creation/delete/{id}', 'SuperAdmin\InvoiceCreationController@delete')->name('invoice_creation.delete');

    Route::resource('invoice_creation', 'SuperAdmin\InvoiceCreationController');


    //AJAX Requests Routes
    Route::get('ajax/get-customers-by-company/{id}', 'SuperAdmin\AjaxController@getCustomersByCompany')->name('ajax.get-customers-by-company');



    //Reports Routes
    Route::get('reports', 'SuperAdmin\ReportsController@view')->name('reports.view');
    Route::post('/reports/store', 'SuperAdmin\ReportsController@store')->name('reports.store');
    Route::get('reports/total-orders', 'SuperAdmin\ReportsController@viewTotalOrders')->name('reports.total-orders');
    Route::post('/reports/total-customer-orders', 'SuperAdmin\ReportsController@totalCustomerOrders')->name('reports.total-customer-orders');
    Route::post('/reports/total-date-orders', 'SuperAdmin\ReportsController@totalDateOrders')->name('reports.total-date-orders');
    Route::post('/reports/total-company-orders', 'SuperAdmin\ReportsController@totalCompanyOrders')->name('reports.total-company-orders');
    Route::get('reports/orders-shipped', 'SuperAdmin\ReportsController@viewOrdersShipped')->name('reports.orders-shipped');
    Route::post('/reports/orders-shipped-customers', 'SuperAdmin\ReportsController@OrdersShippedCustomers')->name('reports.orders-shipped-customers');
    Route::post('/reports/orders-shipped-company', 'SuperAdmin\ReportsController@OrdersShippedCompany')->name('reports.orders-shipped-company');
    Route::get('/reports/orders-shipped-branded-products/{id}', 'SuperAdmin\ReportsController@OrdersShippedBrandedProducts')->name('reports.orders-shipped-branded-products');
    Route::post('reports/orders-shipped-date', 'SuperAdmin\ReportsController@OrdersShippedDateReport')->name('reports.orders-shipped-date-report');
    Route::get('reports/order-status', 'SuperAdmin\ReportsController@viewOrderStatus')->name('reports.order-status');
    Route::post('/reports/order-status-customer', 'SuperAdmin\ReportsController@OrderStatusCustomer')->name('reports.order-status-customer');
    Route::post('/reports/order-status-company', 'SuperAdmin\ReportsController@OrderStatusCompany')->name('reports.order-status-company');
    Route::get('reports/shipment-plan-view', 'SuperAdmin\ReportsController@shipmentPlanView')->name('reports.shipment-plan-view');
    Route::post('reports/shipment-plan-view', 'SuperAdmin\ReportsController@shipmentPlanReport')->name('reports.shipment-plan-report');
    Route::get('/reports/receivable-report-view', 'SuperAdmin\ReportsController@viewReceivableReport')->name('reports.viewReceivableReport');
    Route::get('/reports/receivable-report', 'SuperAdmin\ReportsController@receivableReport')->name('reports.receivableReport');
    Route::get('reports/payment-ledger', 'SuperAdmin\ReportsController@viewPaymentLedger')->name('reports.payment-ledger');
    Route::post('/reports/payment-ledger-customer', 'SuperAdmin\ReportsController@PaymentLedgerCustomer')->name('reports.payment-ledger-customer');
    Route::post('reports/payment-ledger-date', 'SuperAdmin\ReportsController@PaymentLedgerDateReport')->name('reports.payment-ledger-date');
    Route::get('/reports/custom-invoice', 'SuperAdmin\ReportsController@ViewCustomInvoice')->name('reports.view-custom-invoice');
    Route::get('/reports/custom-invoice/{id}', 'SuperAdmin\ReportsController@CustomInvoice')->name('reports.custom-invoice');
    Route::get('/reports/packing-list', 'SuperAdmin\ReportsController@ViewPackingList')->name('reports.view-packing-list');
    Route::post('/reports/packing-list-report', 'SuperAdmin\ReportsController@PackingList')->name('reports.packing-list-report');
    Route::get('/reports/bol-format', 'SuperAdmin\ReportsController@ViewBolFormat')->name('reports.view-bol-format');
    Route::get('/reports/bol-format-report/{id}', 'SuperAdmin\ReportsController@BolFormat')->name('reports.bol-format-report');


    //Excel Routes
    Route::get('total-orders-customer/exportExcel/{id}', 'SuperAdmin\ReportsController@exportTotalOrdersCustomerExcel')->name('total-orders-customer.excel');
    Route::get('total-orders-company/exportExcel/{id}', 'SuperAdmin\ReportsController@exportTotalOrdersCompanyExcel')->name('total-orders-company.excel');
    Route::get('total-orders-perfoma-invoice/exportExcel/{id}', 'SuperAdmin\ReportsController@exportTotalOrdersPerfomaInvoiceExcel')->name('total-orders-perfoma-invoice.excel');
    Route::get('order-shipped-customer/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrderShippedCompanyExcel')->name('order-shipped-customer.excel');
    Route::get('order-shipped-company/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrdersShippedCompanyExcel')->name('order-shipped-company.excel');
    Route::get('order-branded-products/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrderShippedProductBrandExcel')->name('order-branded-products.excel');
    Route::get('order-shipped-date/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrdersShippedDateExcel')->name('order-shipped-date.excel');
    Route::get('order-status-customer/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrderStatusCustomerExcel')->name('order-status-customer.excel');
    Route::get('order-status-company/exportExcel/{id}', 'SuperAdmin\ReportsController@exportOrderStatusCompanyExcel')->name('order-status-company.excel');
    Route::get('payment-ledger-customer/exportExcel/{id}', 'SuperAdmin\ReportsController@exportPaymentLedgerCustomerExcel')->name('payment-ledger-customer.excel');
    Route::get('custom-invoice/exportExcel/{id}', 'SuperAdmin\ReportsController@exportCustomInvoice')->name('custom-invoice.excel');
    Route::get('packing-list/exportExcel/{id}', 'SuperAdmin\ReportsController@exportPackingList')->name('packing-list.excel');
});
