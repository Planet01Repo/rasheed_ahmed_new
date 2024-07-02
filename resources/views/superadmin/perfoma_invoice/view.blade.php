@extends('layouts.layout')

<style>
    th.sorting {
        width: 100px !important;
    }

    th.sorting_disabled {
        width: 80px !important;
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
                <li><a href="#" class="active">View All <?= isset($title) ? $title : '' ?></a> </li>
            </ul>
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h3>View All - <span class="semi-bold"><?= isset($title) ? $title : '' ?></span></h3>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="grid simple ">
                        <div class="clearfix"></div>
                        <br>

                        <div class="grid-title">
                            <h4>View All <span class="semi-bold"><?= isset($title) ? $title : '' ?></span></h4>
                            <a style="float: right; margin-top: -5px;" class="btn btn-success btn-cons add-button"
                                href="{{ route('perfoma_invoice.add') }}">Add</a>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="grid-body ">
                            <table class="table" id="example3">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <!--<th>Invoice No</th>-->
                                        <th>Perfoma Invoice No</th>
                                        <th>Customer Name</th>
                                        <th>Description</th>
                                        <th>PO Number</th>
                                        <th>PI Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)
                                    @foreach ($data as $v)
                                        <tr class="">
                                            <td>{{ $count++ }}</td>
                                            <!--<td>{{ $v->perfoma_invoice_no }}</td>-->
                                            <td>{{ $v->perfoma_invoice_no_local }}</td>
                                            <td>{{ $v->customer['customer_company_name'] }}</td>
                                            <td>{!! $v->description !!}</td>
                                            <td>{!! $v->po_number !!}</td>
                                            <td>{!! $v->pi_date !!}</td>
                                            <td>
                                                <a href="{{ route('perfoma_invoice.detail', $v->id) }}"
                                                    class="d-inline btn-primary btn btn-sm " style="margin-top: 4px"
                                                    title="View Detail"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('perfoma_invoice.add') }}/{{ $v['id'] }}"
                                                    class="d-inline btn-warning btn btn-sm" style="margin-top: 4px"
                                                    data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('perfoma_invoice.pdf', $v->id) }}" target="_blank"
                                                    class="d-inline btn-primary btn btn-sm " title="View Pdf"><i
                                                        class="fa fa-print"></i></a>
                                                {{-- <a href="{{route('perfoma_invoice.delete', $v['id'])}}" rel="delete" style="margin-top: 4px" class="d-inline ajax btn-danger btn btn-sm delete-button"><i class="fa fa-times"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    </script>
@endsection
