@extends('layouts.layout')
@section('content')
<!-- BEGIN PAGE CONTAINER-->
<style>
    .modal-backdrop.in {
        position: relative !important;
    }
    span.close {
        position: relative;
        top: -2 !important;
    }
    .responsive-scroll {
        background: white;
        padding: 20px !important;
    }
    .background-change th {
        background: #6f7b8a;
        color: white;
    }
    table.table.table-bordered {
      background: #ecf0f2 !important;
    }
    .td-border-left{
      border-left: 1px solid rgb(192, 192, 192) !important;
    }
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }
</style>
<div id="bankDetailsModal" class="modal">             
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-body">
            <form action="" method="POST" id="bankDetailForm">
                <input type="hidden" name="company_id" value="{{$company->id}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <span style="margin-top: -25px;" class="close">&times;</span>
                        <div id="bankDetailsError" class="alert alert-danger" style="display: none;">
                        </div>
                            <div class="row" style="padding-top: 5px !important">
                                <div class="col-md-12">
                                    <div class="responsive-scroll  modal-body" style="width: 100%;">
                                        <h4>Bank Details</h4>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="row ">
                                                    <div class="col-sm-12 col-md-12">
                                                        <label class="form-label">Branch Name</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9">
                                                        <div class="input-with-icon right controls">
                                                            <i class=""></i>
                                                            <input name="branch_name" type="text" value=""
                                                        class="form-control @error('branch_name') is-invalid @enderror" placeholder="Enter Branch Name">
                                                        @error('branch_name')
                                                            <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="row ">
                                                    <div class="col-sm-12 col-md-12">
                                                        <label class="form-label">Branch Address</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9">
                                                        <div class="input-with-icon right controls">
                                                            <i class=""></i>
                                                            <input name="branch_address" type="text" value=""
                                                        class="form-control @error('branch_address') is-invalid @enderror" placeholder="Enter Branch Address">
                                                        @error('branch_address')
                                                            <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label">Branch Code</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="branch_code" type="text" value=""
                                                    class="form-control @error('branch_code') is-invalid @enderror" placeholder="Enter Branch Code">
                                                    @error('branch_code')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Account Name</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="account_name" type="text" value=""
                                                class="form-control @error('account_name') is-invalid @enderror" placeholder="Enter Account Name">
                                                @error('account_name')
                                                    <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row ">
                                        <div class="col-sm-12 col-md-12">
                                            <label class="form-label">Account Number</label>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <div class="input-with-icon right controls">
                                                <i class=""></i>
                                                <input name="account_number" type="text" value=""
                                            class="form-control @error('account_number') is-invalid @enderror" placeholder="Enter Account Number">
                                            @error('account_number')
                                                <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-sm-12 col-md-12">
                                        <label class="form-label">Iban Number</label>
                                    </div>
                                    <div class="col-sm-12 col-md-9">
                                        <div class="input-with-icon right controls">
                                            <i class=""></i>
                                            <input name="iban_number" type="text" value=""
                                        class="form-control @error('iban_number') is-invalid @enderror" placeholder="Enter Iban Number">
                                        @error('iban_number')
                                            <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label">Swift Code</label>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div class="input-with-icon right controls">
                                        <i class=""></i>
                                        <input name="swift_code" type="text" value=""
                                    class="form-control @error('swift_code') is-invalid @enderror" placeholder="Enter Swift Code">
                                    @error('swift_code')
                                        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" style="margin-top: 10px" class="btn btn-succes">Add</button>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="page-content">
<div class="content">
<ul class="breadcrumb">
<li>
<p>Dashboard</p>
</li>
<li>
Company
</li>
<li>
Bank Details
</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4><span class="semi-bold">Bank Details Form</span></h4>
                <a class="btn btn-primary" style="float: right" id="btn_add_rows">Add Details</a>
            </div>
            <div class="grid-body no-border">
                    <div class="col-md-12">
                        <div class="row" style="padding-top: 5px !important">
                            <div class="col-md-12">
                                <div class="responsive-scroll" style="width: 100%;">
                                    <table class="table company-respnsve-table" id="example3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Branch Name</th>
                                                <th class="text-center">Branch Address</th>
                                                <th class="text-center">Branch Code</th>
                                                <th class="text-center">Account Name</th>
                                                <th class="text-center">Account Number</th>
                                                <th class="text-center">Iban Number</th>
                                                <th class="text-center">Swift Code</th>
                                                <th class="text-center">Action</th>
    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$item->branch_name}}</td>
                                                    <td>{{$item->branch_address}}</td>
                                                    <td>{{$item->branch_code}}</td>
                                                    <td>{{$item->account_name}}</td>
                                                    <td>{{$item->account_number}}</td>
                                                    <td>{{$item->iban_number}}</td>
                                                    <td>{{$item->swift_code}}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn-warning btn btn-sm edit_btn" data-value="{{$item->id}}" data-toggle="tooltip" title="Edit Bank Details"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{route('company-bankDetails.destroy', $item['id'])}}" rel="delete" class="ajax btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <br>
                            <a href="{{route('company.view')}}" class="btn btn-default btn-cons"
                                >Back</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- END BASIC FORM ELEMENTS-->
@include('includes.bank_details_modal')
@endsection
@section('footer')
<script>
    $(document).ready(function () {
    var modal = document.getElementById("bankDetailsModal");
    // var modal1 = document.getElementById("editBankDetailsModal");
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function () {
        $('#bankDetailsModal').modal('hide');
        $('#editBankDetailsModal').modal1('hide');
    }
        $(document).on('click', "#btn_add_rows", function () {
            $('#bankDetailsModal').modal('show');
    });
    $(document).on('click', '.edit_btn', function (e) { 
        console.log('zaky');
        let id = $(this).attr('data-value')
        $('#editBankDetailsModal').modal('show');
        $.get( "/editBankDetails/"+id, function( data ) {
            $('#editBankDetailsModal .modal-content').html(data);
        });
    });
    $(document).on('submit', "#bankDetailForm", function (e) {
        e.preventDefault();
        console.log('zaky');
        $.ajax({
        url: "{{route('company.saveBankDetails')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#bankDetailsModal').modal('hide');
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#bankDetailsModal #bankDetailsError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    });
    $(document).on('submit', "#editBankDetailForm", function (e) {
        e.preventDefault();
        console.log('zaky');
        $.ajax({
        url: "{{route('company.updateBankDetails')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#editBankDetailsModal').modal('hide');
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#editBankDetailsModal #bankDetailsError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    });
    $("form.validate").validate({
          rules: {
            title: {
              required: true
            },
            /* prefix:{
               required: true
             },*/
          },
          messages: {},
          invalidHandler: function(event, validator) {
            //display error alert on form submit 
            error("Please input all the mandatory values marked as red");
          },
          errorPlacement: function(label, element) { // render error placement for each input type   
            var icon = $(element).parent('.input-with-icon').children('i');
            icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
            $('<span class="error"></span>').insertAfter(element).append(label);
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');
          },
          highlight: function(element) { // hightlight error inputs
            var icon = $(element).parent('.input-with-icon').children('i');
            icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control');
          },
          unhighlight: function(element) { // revert the change done by hightlight
            var icon = $(element).parent('.input-with-icon').children('i');
            icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
            var parent = $(element).parent();
            parent.removeClass('error-control').addClass('success-control');
          },
          success: function(label, element) {
            var icon = $(element).parent('.input-with-icon').children('i');
            icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control');
          }
        });
    });
</script>
@endsection