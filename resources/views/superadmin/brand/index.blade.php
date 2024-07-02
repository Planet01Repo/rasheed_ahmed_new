@extends('layouts.layout')

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
                            <a style="float: right;" class="btn btn-success btn-cons"
                                href="{{ route('brand.create') }}">Add</a>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="grid-body ">
                            <table class="table company-respnsve-table" id="example3">
                                <thead>
                                    <tr>
                                        <th style="min-width: 39px;">S.No</th>
                                        <th style="min-width: 150px;">Name</th>
                                        <th style="min-width: 150px;">Status</th>
                                        <th style="min-width: 120px;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)
                                    @foreach ($data as $v)
                                        <tr class="">
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $v->name }}</td>
                                            <td>{{ $v->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('brand.edit', @$v->id) }}"
                                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Brand"><i
                                                        class="fa fa-edit"></i></a>
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
@endsection
@section('footer')
@endsection
