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
        top: 26px;
    }

    .pdf-button {
        position: relative;
        right: 7%;
        top: 26px;
    }

    i.fa.fa-file {
        padding: 3px;
    }

    .top {
        padding-top: 22px;
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
                            <h3 class="semi-bold">Payment Ledger Report</h3>
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
                                    <h4 class="semi-bold">Payment Ledger Report Via Date</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row ">
                                        <form action="{{ route('reports.payment-ledger-date') }}" method="POST">
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
                                            <div class="col-md-2">
                                                <label for="">Export Type</label>
                                                <select name="export_type" id="">
                                                    <option value="pdf">PDF</option>
                                                    <option value="excel">EXCEL</option>
                                                </select>
                                                @error('export_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 top">
                                                <div class="form-group">
                                                    <input type="submit" value="Generate Report" formtarget="_blank"
                                                        class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Payment Ledger Report Via Customer</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row remove-margin-left">
                                        <form action="{{ route('reports.payment-ledger-customer') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="payment_ledger_customer">
                                            <div class="col-md-2">
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
                                            <div class="col-md-2">
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
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Customer</label>
                                                    <select
                                                        class="form-control select2 @error('customer_id') is-invalid @enderror"
                                                        id="customer_id" name="customer_id">
                                                        <option value="" selected="" disabled="">-- Select
                                                            Customer
                                                            --
                                                        </option>
                                                        @foreach ($customer as $k => $v)
                                                            <option value="{{ $v->id }}">
                                                                {{ $v->customer_company_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('customer_id')
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
                                            <div class="col-md-3 top">
                                                <div class="form-group">
                                                    <input type="submit" value="Generate Report" class="btn btn-primary"
                                                        formtarget="_blank">
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('includes.detail_modal')
@endsection
@section('footer')
    <script>
        function detail_template(data) {
            var temp = "";
            temp += "<p><span style='font-weight:bold;'>Address  </span>" + data.address + " </p>";
            return temp;
        }
        $(document).ready(function() {
            var a = $('#customer_id').val();
            if (a == '' || a == null) {
                // $('#excel-button').dialog();
                $('#excel-shipped-button').prop('disabled', true);

                $(document).on('change', '#customer_id', function() {
                    $('#excel-shipped-button').prop('disabled', false);
                })
            }

            var b = $('#branded_products').val();
            if (b == '' || b == null) {
                // $('#excel-button').dialog();
                $('#excel-brand-products').prop('disabled', true);

                $(document).on('change', '#branded_products', function() {
                    $('#excel-brand-products').prop('disabled', false);
                })
            }
            var c = $('#company_id').val();
            if (c == '' || c == null) {
                // $('#excel-button').dialog();
                $('#excel-shipped-company').prop('disabled', true);

                $(document).on('change', '#company_id', function() {
                    $('#excel-shipped-company').prop('disabled', false);
                })
            }
        });

        function getCustomershipmentIds() {
            var a = $('#customer_id').val();
            var route = '{{ route('payment-ledger-customer.excel', ':id') }}';
            if (a != '' || a != null) {
                route = route.replace(':id', a)
                window.location.href = route;
            }
        }

        function getBrandedProductshipmentIds() {

            var b = $('#branded_products').val();
            // console.log(b);
            var route = '{{ route('order-branded-products.excel', ':id') }}';
            if (b != '' || b != null) {
                route = route.replace(':id', b)
                window.location.href = route;
            }
        }

        function getShippmentCompanyIds() {
            var b = $('#company_id').val();
            // console.log(b);
            var route = '{{ route('order-shipped-company.excel', ':id') }}';
            if (b != '' || b != null) {
                route = route.replace(':id', b)
                window.location.href = route;
            }
        }
    </script>
@endsection
