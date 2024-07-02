@extends('layouts.layout')

<style>
    th.sorting {
        width: 100px !important;
    }

    th.sorting_disabled {
        width: 80px !important;
    }

    .custom-generate {
        position: relative;
        top: 25px;
    }

    button#excel-button,
    button#excel-button1,
    button#excel-button2 {
        position: relative;
        right: 7%;
        top: 26px;
    }

    i.fa.fa-file {
        padding: 3px;
    }

    .remove-margin-left {
        margin-left: 0px !important;
    }
</style>
@section('content')
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>Dashboard</p>
                </li>
                <li><a href="#" class="active">View All Reports</a> </li>
            </ul>
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h3>View All - <span class="semi-bold">Reports</span></h3>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="grid simple ">
                        <div class="clearfix"></div>
                        <br>

                        <div class="grid-title">
                            <h4>View All <span class="semi-bold">Reports</span></h4>
                            <div class="pull-right"></div>
                        </div>
                        <div class="grid-body ">
                            <h3 class="semi-bold">Total Orders Report</h3>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <strong></strong> {{ Session::get('error') }}
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <strong>Success!</strong> {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Total Orders Report Via Date</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row">
                                        <form action="{{ route('reports.total-date-orders') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="orders_shipped_date">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="from_date" class="control-label">From Date:</label>
                                                    <input type="date" id="from_date"
                                                        class="form-control @error('from_date') is-invalid @enderror"
                                                        name="from_date" value="{{ @$from_date }}">
                                                    @error('from_date')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="to_date" class="control-label">To Date:</label>
                                                    <input type="date" id="to_date"
                                                        class="form-control @error('to_date') is-invalid @enderror"
                                                        name="to_date" value="{{ @$to_date }}">
                                                    @error('to_date')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Export Type</label>
                                                <select name="export_type" id="">
                                                    <option value="pdf">PDF</option>
                                                    <option value="excel">EXCEL</option>
                                                </select>
                                                @error('export_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 custom-generate">
                                                <div class="form-group">
                                                    <input type="submit" value="Generate Report" formtarget="_blank"
                                                        class="btn btn-primary" style=" width: 100%;text-align: center">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Total Orders Report Via Customer</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row remove-margin-left">
                                        <form action="{{ route('reports.total-customer-orders') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="total_orders_customer">
                                            <div div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="from_date" class="control-label">From Date:</label>
                                                        <input type="date" id="from_date"
                                                            class="form-control @error('from_date') is-invalid @enderror"
                                                            name="from_date" value="{{ @$from_date }}">
                                                        @error('from_date')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="to_date" class="control-label">To Date:</label>
                                                        <input type="date" id="to_date"
                                                            class="form-control @error('to_date') is-invalid @enderror"
                                                            name="to_date" value="{{ @$to_date }}">
                                                        @error('to_date')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label my-label-style">Customer</label>
                                                        <select
                                                            class="form-control select2 @error('customer_id') is-invalid @enderror"
                                                            id="customer_id" name="customer_id">
                                                            <option value="" selected="" disabled="">--
                                                                Select Customer
                                                                --</option>
                                                            @foreach ($customer as $k => $v)
                                                                <option value="{{ $v->id }}">
                                                                    {{ $v->customer_company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('customer_id')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Export Type</label>
                                                    <select name="export_type" id="">
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">EXCEL</option>
                                                    </select>
                                                    @error('export_type')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 custom-generate">
                                                    <input type="submit" value="Generate Report" formtarget="_blank"
                                                        class="btn btn-primary" style="width: 100%; text-align: center">
                                                </div>
                                            </div>
                                        </form>
                                        {{-- <div class="col-md-2">
                                            <button onclick="getCustomerIds()" target="_blank" style="font-size: 20px;"
                                                class=" btn-danger btn btn-xl pdf-button" id="excel-button" title="View Excel"><i
                                                    class="fa fa-file-excel-o"></i></button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Total Orders Report Via Company</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row remove-margin-left">
                                        <form action="{{ route('reports.total-company-orders') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="total_orders_company">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="from_date" class="control-label">From Date:</label>
                                                        <input type="date" id="from_date"
                                                            class="form-control @error('from_date') is-invalid @enderror"
                                                            name="from_date" value="{{ @$from_date }}">
                                                        @error('from_date')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="to_date" class="control-label">To Date:</label>
                                                        <input type="date" id="to_date"
                                                            class="form-control @error('to_date') is-invalid @enderror"
                                                            name="to_date" value="{{ @$to_date }}">
                                                        @error('to_date')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label my-label-style">Company</label>
                                                        <select
                                                            class="form-control select2 @error('company_id') is-invalid @enderror"
                                                            id="company_id" name="company_id">
                                                            <option value="" selected="" disabled="">--
                                                                Select
                                                                Company --</option>
                                                            @foreach ($company as $k => $v)
                                                                <option value="{{ $v->id }}">{{ $v->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('company_id')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Export Type</label>
                                                    <select name="export_type" id="">
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">EXCEL</option>
                                                    </select>
                                                    @error('export_type')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 custom-generate">
                                                    <input type="submit" value="Generate Report" formtarget="_blank"
                                                        class="btn btn-primary" style="width: 100%; text-align: center">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            var a = $('#customer_id').val();
            if (a == '' || a == null) {
                // $('#excel-button').dialog();
                $('#excel-button').prop('disabled', true);

                $(document).on('change', '#customer_id', function() {
                    $('#excel-button').prop('disabled', false);
                })
            }
            var b = $('#company_id').val();
            if (b == '' || b == null) {
                // $('#excel-button').dialog();
                $('#excel-button1').prop('disabled', true);

                $(document).on('change', '#company_id', function() {
                    $('#excel-button1').prop('disabled', false);
                })
            }
            var c = $('#perfoma_invoice_no').val();
            if (c == '' || c == null) {
                // $('#excel-button').dialog();
                $('#excel-button2').prop('disabled', true);

                $(document).on('change', '#perfoma_invoice_no', function() {
                    $('#excel-button2').prop('disabled', false);
                })
            }
        });

        function getCustomerIds() {
            var a = $('#customer_id').val();
            var route = '{{ route('total-orders-customer.excel', ':id') }}';
            if (a != '' || a != null) {
                route = route.replace(':id', a)
                window.location.href = route;
            }
        }

        function getCompanyIds() {
            var b = $('#company_id').val();
            console.log(b);
            var route = '{{ route('total-orders-company.excel', ':id') }}';
            if (b != '' || b != null) {
                route = route.replace(':id', b)
                window.location.href = route;
            }
        }

        function getPerfomaInvoiceIds() {
            var c = $('#perfoma_invoice_no').val();
            console.log(c);
            var route = '{{ route('total-orders-perfoma-invoice.excel', ':id') }}';
            if (c != '' || c != null) {
                route = route.replace(':id', c)
                window.location.href = route;
            }
        }
    </script>
@endsection
