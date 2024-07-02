<!--BEGIN SIDEBAR -->
<div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
        <ul>

            <li
                class="{{ Route::currentRouteName() == 'company.view' || Route::currentRouteName() == 'company.add' ? 'active open' : '' }}>">
                <a href="{{ route('company.view') }}"> <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span class="title">Company</span>
                </a>
            </li>
            <li
                class="{{ Route::currentRouteName() == 'brand.index' || Route::currentRouteName() == 'brand.create' ? 'active open' : '' }}>">
                <a href="{{ route('brand.index') }}"> <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span class="title">Brand</span>
                </a>
            </li>
            <li
                class="{{ Route::currentRouteName() == 'customer.view' || Route::currentRouteName() == 'customer.add' ? 'active open' : '' }}>">
                <a href="{{ route('customer.view') }}"> <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="title">Customer</span>
                </a>
            </li>
            <li
                class="{{ Route::currentRouteName() == 'supplier.view' || Route::currentRouteName() == 'supplier.add' ? 'active open' : '' }}>">
                <a href="{{ route('supplier.view') }}"> <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="title">Supplier</span>
                </a>
            </li>

            <li
                class="{{ Route::currentRouteName() == 'product.detail' || Route::currentRouteName() == 'product.view' || Route::currentRouteName() == 'product.add' || Route::currentRouteName() == 'carton.view' || Route::currentRouteName() == 'carton.add' || Route::currentRouteName() == 'material.view' || Route::currentRouteName() == 'material.add' || Route::currentRouteName() == 'size.view' || Route::currentRouteName() == 'size.add' ? 'active open' : '' }}">
                <a href="#"> <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                    <span class="title">General Items</span>
                    <span class="selected"></span>
                    <span
                        class="arrow {{ Route::currentRouteName() == 'product.detail' || Route::currentRouteName() == 'product.view' || Route::currentRouteName() == 'product.add' || Route::currentRouteName() == 'carton.view' || Route::currentRouteName() == 'carton.add' || Route::currentRouteName() == 'material.view' || Route::currentRouteName() == 'material.add' || Route::currentRouteName() == 'size.view' || Route::currentRouteName() == 'size.add' ? 'active open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li
                        class="{{ Route::currentRouteName() == 'size.view' || Route::currentRouteName() == 'size.add' ? 'active' : '' }}">
                        <a href="{{ route('size.view') }}"> Size </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'carton.view' || Route::currentRouteName() == 'carton.add' ? 'active' : '' }}">
                        <a href="{{ route('carton.view') }}"> Carton </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'material.view' || Route::currentRouteName() == 'material.add' ? 'active' : '' }}">
                        <a href="{{ route('material.view') }}"> Material </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'po_material.view' || Route::currentRouteName() == 'po_material.add' ? 'active' : '' }}">
                        <a href="{{ route('po_material.view') }}"> PO Material </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'product.detail' || Route::currentRouteName() == 'product.view' || Route::currentRouteName() == 'product.add' ? 'active' : '' }}">
                        <a href="{{ route('product.view') }}"> Product </a>
                    </li>
                </ul>
            </li>



            <li
                class="{{ Route::currentRouteName() == 'perfoma_invoice.view' || Route::currentRouteName() == 'perfoma_invoice.add' || Route::currentRouteName() == 'purchase_order.view' || Route::currentRouteName() == 'purchase_order.add' || Route::currentRouteName() == 'packing_list.view' || Route::currentRouteName() == 'packing_list.add' ? 'active open' : '' }}">
                <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="title">Sales Management</span>
                    <span class="selected"></span>
                    <span
                        class="arrow {{ Route::currentRouteName() == 'perfoma_invoice.view' || Route::currentRouteName() == 'perfoma_invoice.add' ? 'active open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li
                        class="{{ Route::currentRouteName() == 'packing_list.view' || Route::currentRouteName() == 'packing_list.add' ? 'active' : '' }}">
                        <a href="{{ route('packing_list.view') }}"> Packing List </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'perfoma_invoice.view' || Route::currentRouteName() == 'perfoma_invoice.add' ? 'active' : '' }}">
                        <a href="{{ route('perfoma_invoice.view') }}"> Proforma Invoice </a>
                    </li>
                    <li class="{{ Request::segment(2) == 'invoice_creation' ? 'active' : '' }}"> <a
                            href="{{ route('invoice_creation.index') }}"> Invoice Creation </a> </li>
                    <li
                        class="{{ Route::currentRouteName() == 'purchase_order.view' || Route::currentRouteName() == 'purchase_order.add' ? 'active' : '' }}">
                        <a href="{{ route('purchase_order.view') }}"> Purchase Order </a>
                    </li>
                </ul>
            </li>

            {{-- <li>
          <a href="{{ route('reports.view') }}"> <i class="fa fa-users" aria-hidden="true"></i>
            <span class="title">Reports</span>
          </a>
        </li> --}}

            <li
                class="{{ Route::currentRouteName() == 'change.password.form' || Route::currentRouteName() == 'delete.view' ? 'active open' : '' }}">
                <a href="#"> <i class="fa fa-print" aria-hidden="true"></i>
                    <span class="title">Reports</span>
                    <span class="selected"></span>
                    <span
                        class="arrow {{ Route::currentRouteName() == 'change.password.form' || Route::currentRouteName() == 'delete.view' ? 'active open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Route::currentRouteName() == 'reports.total-orders' ? 'active' : '' }}"> <a
                            href="{{ route('reports.total-orders') }}"> Total Orders </a> </li>
                    <li class="{{ Route::currentRouteName() == 'reports.orders-shipped' ? 'active' : '' }}"> <a
                            href="{{ route('reports.orders-shipped') }}"> Orders Shipped </a> </li>
                    <li class="{{ Route::currentRouteName() == 'reports.order-status' ? 'active' : '' }}"> <a
                            href="{{ route('reports.order-status') }}"> Order Status </a> </li>
                    <li class="{{ Route::currentRouteName() == 'reports.shipment-plan-view' ? 'active' : '' }}"> <a
                            href="{{ route('reports.shipment-plan-view') }}"> Shipment Plan </a> </li>
                    <li class="{{ Route::currentRouteName() == 'reports.viewReceivableReport' ? 'active' : '' }}">
                        <a href="{{ route('reports.viewReceivableReport') }}"> Receivables </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'reports.reports.payment-ledger' ? 'active' : '' }}">
                        <a href="{{ route('reports.payment-ledger') }}"> Payment Ledger </a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'reports.reports.view-custom-invoice' ? 'active' : '' }}">
                        <a href="{{ route('reports.view-custom-invoice') }}"> Custom Invoice </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'reports.reports.view-packing-list' ? 'active' : '' }}">
                        <a href="{{ route('reports.view-packing-list') }}"> Packing List </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'reports.reports.view-bol-format' ? 'active' : '' }}">
                        <a href="{{ route('reports.view-bol-format') }}"> BOL Format </a>
                    </li>
                </ul>
            </li>
            <li
                class="{{ Route::currentRouteName() == 'change.password.form' || Route::currentRouteName() == 'delete.view' ? 'active open' : '' }}">
                <a href="#"> <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span class="title">Settings</span>
                    <span class="selected"></span>
                    <span
                        class="arrow {{ Route::currentRouteName() == 'change.password.form' || Route::currentRouteName() == 'delete.view' ? 'active open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active' : '' }}"> <a
                            href="{{ route('change.password.form') }}"> Change Password </a> </li>
                    <li class="{{ Route::currentRouteName() == 'delete.view' ? 'active' : '' }}"> <a
                            href="{{ route('delete.view') }}"> Delete </a> </li>
                </ul>
            </li>

            <li class="{{ Route::currentRouteName() == 'logout' ? 'active open' : '' }}>">
                <a href="{{ route('logout') }}"> <i class="fa fa-power-off" aria-hidden="true"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
            <!-- <li class="">
           <a href="#"> <i class="fa fa-calculator" aria-hidden="true"></i>
            <span class="title">Data Entry</span>
            <span class="selected"></span>
            <span class="arrow {{ Route::currentRouteName() == 'change.password.form' ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Size</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Carton</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Order</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Purchase Order</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Shipping</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Purchase Order Entry</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Category</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Material</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Assign Order</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Contractor</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Factory</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Stock</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Cutter</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Cutting Department</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Order</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Articale</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Cutting Pending</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Sticher</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Stiching Department</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Stiching Pending</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Paser</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Passing Department</a></li>
              <li class="{{ Route::currentRouteName() == 'change.password.form' ? 'active ' : '' }}"> <a href="{{ route('change.password.form') }}">Passing Altered</a></li>

            </ul>
                 </li> -->



        </ul>
        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<a href="#" class="scrollup">Scroll</a>
