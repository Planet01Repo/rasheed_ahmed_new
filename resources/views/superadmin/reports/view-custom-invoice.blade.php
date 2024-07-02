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
        top: 5px;
    }

    button#excel-shipped-button,
    button#excel-brand-products,
    button#excel-shipped-company {
        position: relative;
        right: 7%;
        top: 5px;
    }

    i.fa.fa-file {
        padding: 3px;
    }

    .top {
        padding-top: 22px;
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
                            <h3 class="semi-bold">Custom Invoice Report</h3>
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
                            <div class="row">
                                <form action="{{ route('reports.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="customer_invoice">
                                    <div div class="col-md-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="form-label my-label-style">Invoice</label>
                                                <select class="form-control select2 @error('invoice') is-invalid @enderror"
                                                    id="invoice" name="invoice">
                                                    <option value="" selected="" disabled="">-- Select Invoice
                                                        --
                                                    </option>
                                                    @foreach ($invoice as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->invoice_no }}</option>
                                                    @endforeach
                                                </select>
                                                @error('invoice')
                                                    <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="col-md-3 col-lg-2 custom-generate">
                                        <input type="submit" value="Generate Report" formtarget="_blank"
                                            class="btn btn-primary" style="width: 100%; text-align: center">
                                    </div>
                                </form>
                                <div class="col-md-2">
                                    <button onclick="getCustomershipmentIds()" target="_blank"
                                        class="btn-danger btn btn-xl pdf-button" style="font-size: 20px;"
                                        id="excel-shipped-button" title="View Excel"><i
                                            class="fa fa-file-excel-o"></i></button>
                                </div>
                                <br>
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
            var a = $('#invoice').val();
            if (a == '' || a == null) {
                // $('#excel-button').dialog();
                $('#excel-shipped-button').prop('disabled', true);

                $(document).on('change', '#invoice', function() {
                    $('#excel-shipped-button').prop('disabled', false);
                })
            }
        });

        function getCustomershipmentIds() {
            var a = $('#invoice').val();
            var route = '{{ route('custom-invoice.excel', ':id') }}';
            if (a != '' || a != null) {
                route = route.replace(':id', a)
                window.location.href = route;
            }
        }
    </script>
@endsection
