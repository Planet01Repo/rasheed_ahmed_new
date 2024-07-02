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

    h5.semi-bold {
        margin-left: 15px;
    }

    .report {
        /* width: %; */
        padding-left: 14px;
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
                            {{-- @if (isset($msg))

                    @endif --}}
                        </div>
                        <div class="grid-body ">
                            <h3 class="semi-bold">Receivables Report</h3>
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
                                    <h4 class="semi-bold">Currency Rates</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row">
                                        @php
                                            $currency = currency();
                                            unset($currency[2]);
                                        @endphp
                                        @foreach ($currency as $key => $item)
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="">{{ $item }}</label>
                                                    <input type="number" class="form-control currency"
                                                        data-value="{{ $item }}" id=""
                                                        onkeypress="allowNumericalAndDotInput(event)" min=1
                                                        value="{{ old($item) }}">
                                                </div>
                                                @error($item)
                                                    <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="">Report Type</label>
                                                <select class="form-control" id="report">
                                                    <option value="pdf" selected>PDF</option>
                                                    <option value="excel">Excel</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Receivables Report Via Date</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row">
                                        <form action="{{ route('reports.receivableReport') }}" method="GET"
                                            target="_blank">
                                            @foreach ($currency as $key => $item)
                                                <input type="hidden" class=" {{ $item }}"
                                                    name="{{ $item }}">
                                            @endforeach
                                            <input type="hidden" name="type" value="receivable_date_range">
                                            <input type="hidden" class="report" name="report" value="pdf">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date From</label>
                                                    <input type="date" class="form-control" name="date_from">
                                                    @error('date_from')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date to</label>
                                                    <input type="date" class="form-control" name="date_to">
                                                    @error('date_to')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 custom-generate">
                                                <input type="submit" value="Generate Report" class="btn btn-primary">
                                            </div>
                                        </form>
                                        <div class="row">
                                            {{-- <button onclick="getCompanyIds()" target="_blank" class="d-inline btn-danger btn btn-xl pdf-button" id="excel-button1" title="View Excel" ><i class="fa fa-file"></i></button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Receivables Report Via Company</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row">
                                        <form action="{{ route('reports.receivableReport') }}" method="GET"
                                            target="_blank">
                                            @foreach ($currency as $key => $item)
                                                <input type="hidden" class=" {{ $item }}"
                                                    name="{{ $item }}">
                                            @endforeach
                                            <input type="hidden" name="type" value="receivable_company">
                                            <input type="hidden" class="report" name="report" value="pdf">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date From</label>
                                                    <input type="date" class="form-control" name="date_from">
                                                    @error('date_from')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date to</label>
                                                    <input type="date" class="form-control" name="date_to">
                                                    @error('date_to')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Company</label>
                                                    <select
                                                        class="form-control select2 @error('company_id') is-invalid @enderror"
                                                        id="company_id" name="company_id">
                                                        <option value="" selected="" disabled="">-- Select
                                                            Company --
                                                        </option>
                                                        @foreach ($company as $k => $v)
                                                            <option value="{{ $v->id }}">{{ $v->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('company_id')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 custom-generate">
                                                <input type="submit" value="Generate Report" class="btn btn-primary">
                                            </div>
                                        </form>
                                        <div class="row">
                                            {{-- <button onclick="getCompanyIds()" target="_blank" class="d-inline btn-danger btn btn-xl pdf-button" id="excel-button1" title="View Excel" ><i class="fa fa-file"></i></button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid simple">
                                <div class="grid-title">
                                    <h4 class="semi-bold">Receivables Report Via Customer</h4>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="grid-body">
                                    <div class="row">
                                        <form action="{{ route('reports.receivableReport') }}" method="GET"
                                            target="_blank">
                                            @foreach ($currency as $key => $item)
                                                <input type="hidden" class=" {{ $item }}"
                                                    name="{{ $item }}">
                                            @endforeach
                                            <input type="hidden" name="type" value="receivable_customer">
                                            <input type="hidden" class="report" name="report" value="pdf">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date From</label>
                                                    <input type="date" class="form-control" name="date_from">
                                                    @error('date_from')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Date to</label>
                                                    <input type="date" class="form-control" name="date_to">
                                                    @error('date_to')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label my-label-style">Customer</label>
                                                    <select
                                                        class="form-control select2 @error('customer_id') is-invalid @enderror"
                                                        id="customer_id" name="customer_id">
                                                        <option value="" selected="" disabled="">-- Select
                                                            Customer
                                                            --</option>
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
                                            <div class="col-md-2 custom-generate">
                                                <input type="submit" value="Generate Report" class="btn btn-primary">
                                            </div>
                                        </form>
                                        {{-- <button onclick="getCustomerIds()" target="_blank" class=" btn-danger btn btn-xl pdf-button" id="excel-button" title="View Excel" ><i class="fa fa-file"></i></button> --}}
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
        $(document).on('change', '#company_id', function() {
            route = '{{ route('ajax.get-customers-by-company', 'companyid') }}'
            dataId = $(this).val()
            route = route.replace('companyid', dataId)
            $.get(route, function(data, status) {
                $('#customer_id').html(`<option value="" selected="" disabled="">-- Select Customer --
                </option>` + data);
                $('#customer_id').change();
            });
        })

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

        function allowNumericalAndDotInput(e) {
            e = e || window.event;
            var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            if (!charStr.match(/^[0-9]*\.?[0-9]*$/))
                e.preventDefault();
        }


        $('.currency').keyup(function(e) {
            let cur_name = $(this).data('value');
            let val = $(this).val();
            let class_name = '.' + cur_name;
            $(class_name).val(val);
        });

        $('#report').change(function(e) {
            e.preventDefault();
            let val = $(this).val();
            $('.report').val(val);
        });
    </script>
@endsection
