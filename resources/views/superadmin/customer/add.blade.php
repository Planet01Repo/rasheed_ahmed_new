@extends('layouts.layout')
@push('custom-css')
<style>
.bootstrap-tagsinput
{
    height:100px;
}
</style>
@endpush
@section('content')
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li>
                <p>Dashboard</p>
            </li>
            <li>
                Customer
            </li>
            <li><a href="#" class="active">{{isset($data->id) ? 'Edit' : 'Add New'}}
                    {{(isset($title)) ? $title : ''}}</a> </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title no-border">
                        <h4>{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}} <span
                                class="semi-bold">Form</span></h4>
                    </div>
                    <div class="grid-body no-border">
                        <form class="ajaxForm validate" action="{{route('customer.post')}}" method="post">
                            {{-- <form action="{{ route('customer.post') }}" method="POST"> --}}
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Name*</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="uname" type="text" value="{{@$data->name}}"
                                                        class="form-control" placeholder="Enter Name">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">City*</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="city" type="text" value="{{@$data->city}}"
                                                        class="form-control" placeholder="Enter City">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Country*</label>

                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <select class="form-control select2" id="country_id"
                                                        name="country_id">
                                                        <option value="" selected="" disabled="">-- Select Country --
                                                        </option>
                                                        @foreach ($countries as $k => $v)
                                                        <option value="{{$v->id}}"
                                                            {{($v->id == @$data->country_id) ? 'selected' : '' }}>
                                                            {{ $v->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Customer Company Name</label>

                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="customer_company_name" type="text"
                                                        value="{{@$data->customer_company_name}}" class="form-control"
                                                        placeholder="Enter Customer Company Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Bill To</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="bill_to"
                                                        class="form-control">{{@$data->bill_to}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Ship To</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <!-- <textarea name="address" class="form-control" data-role="tagsinput">{{@$data->address}}</textarea> -->
                                                    <input type="text" height="200"  data-role="tagsinput" class="form-control invt" value="{{@$data->address}}" id="address" name="address" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Europe Declaration</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="europe_shipment" rows="7" class="form-control"><?= @$data->europe_shipment; ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Payment Terms</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="payment_terms" type="text"
                                                        value="<?= @$data->payment_terms; ?>" class="form-control"
                                                        placeholder="Enter Payment Terms">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Credit Days</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="credit_days" type="number"
                                                        value="<?= @$data->credit_days; ?>" class="form-control"
                                                        placeholder="Enter Credit Days">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Price Base</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input type="text" name="price_base" class="form-control" placeholder="Enter Price Base" value="{{ @$data->price_base}}">
                                                    {{-- <select class="form-control select2" id=""
                                                        name="price_base">
                                                        <option value="" selected="" disabled="">-- Select Price Base --
                                                        </option>
                                                        <?php
                                                            $priceData = price_base();
                                                            foreach ($priceData as $k2 => $v2) {
                                                        ?>
                                                        <option <?= ($k2 == @$data->price_base) ? 'selected' : ''; ?>
                                                            value='<?= $k2 ?>'><?= $v2 ?></option>
                                                        <?php } ?>
                                                    </select> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Customer Code</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="customer_code" type="text"
                                                        value="<?= @$data->customer_code; ?>" class="form-control"
                                                        placeholder="Enter Customer Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Company*</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <select class="form-control select2" id="company_id"
                                                        name="company_id">
                                                        <option value="" selected="" disabled="">-- Select Company --
                                                        </option>
                                                        @foreach ($companies as $k => $v)
                                                        <option value="{{$v->id}}"
                                                            {{($v->id == @$data->company_id) ? 'selected' : '' }}>
                                                            {{ $v->title }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label my-label-style">Bank Details*</label>
                                        <select 
                                            class="form-control select2 @error('company_detail_id')
is-invalid
@enderror"
                                            id="company_detail_id" name="company_detail_id">
                                            <option value="" selected="" disabled="">-- Select Bank Details--</option>
                                            @foreach ($company_details as $key => $value)
                                            <option value="{{$value->id}}"
                                                {{($value->id == @$data->company_detail_id) ? 'selected' : '' }}>
                                                {{ $value->branch_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('company_detail_id')
                                            <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Status</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <select class="form-control input-signin-mystyle select2"
                                                        id="currency" name="currency">
                                                        <option value="" selected="selected" disabled="">- Select
                                                            Currency -</option>
                                                        <?php
                                      $currency = currency();
                                      foreach ($currency as $k2 => $v2) {
                                      ?>
                                                        <option <?= ($k2 == @$data->currency) ? 'selected' : ''; ?>
                                                            value='<?= $k2 ?>'><?= $v2 ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        </br><button class="btn btn-success btn-cons ajaxFormSubmitAlter"
                                            type="button">Submit</button>
                                            <a href="{{route('customer.view')}}" class="btn btn-default btn-cons"
                                            >Back</a>
                                        <input name="id" type="hidden" value="{{ @$data->id }}">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END BASIC FORM ELEMENTS-->
@endsection
@section('footer')
<script>
    $(document).ready(function () {
        $(function () {
            $('input[data-role=tagsinput]').tagsinput();
        }
        );
        $("form.validate").validate({
            rules: {
                uname: {
                    required: true
                },
                // phone: {
                //     required: true
                // },
                city: {
                    required: true
                },
                country_id: {
                    required: true
                },
                company_id: {
                    required: true
                },
                // customer_company_name: {
                //     required: true
                // }
            },
            messages: {},
            invalidHandler: function (event, validator) {
                //display error alert on form submit 
                error("Please input all the mandatory values marked as red");

            },
            errorPlacement: function (label, element) { // render error placement for each input type   
                var icon = $(element).parent('.input-with-icon').children('i');
                icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
                $('<span class="error"></span>').insertAfter(element).append(label);
                var parent = $(element).parent('.input-with-icon');
                parent.removeClass('success-control').addClass('error-control');
            },
            highlight: function (element) { // hightlight error inputs
                var icon = $(element).parent('.input-with-icon').children('i');
                icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
                var parent = $(element).parent();
                parent.removeClass('success-control').addClass('error-control');
            },
            unhighlight: function (element) { // revert the change done by hightlight
                var icon = $(element).parent('.input-with-icon').children('i');
                icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
                var parent = $(element).parent();
                parent.removeClass('error-control').addClass('success-control');
            },
            success: function (label, element) {
                var icon = $(element).parent('.input-with-icon').children('i');
                icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
                var parent = $(element).parent('.input-with-icon');
                parent.removeClass('error-control').addClass('success-control');

            }

        });
    });

    $(document).ready(function () {
        var companyID = $('#company_id').val();
        console.log(companyID);
        $.get("/getBankDetailsFromCompany/" + companyID, function(data) {
            $('#company_detail_id').html(data);
        });
        $("#company_id").val(companyID);
    });
    
    $(document).on('change', "#company_id", function() {
        let _this = $(this);
        let company_id = _this.val();
        console.log(company_id);
        $.get("/getBankDetailsFromCompany/" + company_id, function(data) {
            $('#company_detail_id').html(data);
        });
        $("#company_id").val(company_id);
    });
</script>
@endsection
