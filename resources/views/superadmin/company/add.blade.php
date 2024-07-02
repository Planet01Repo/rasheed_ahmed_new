@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li>
                <p>Dashboard</p>
            </li>
            <li>
                Company
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
                        <form class="ajaxForm validate" action="{{route('company.post')}}" method="post"
                        enctype="multipart/form-data" >
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
                                                    <input name="title" type="text" value="{{@$data->title}}"
                                                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter Name">
                                                </div>
                                                @error('title')
                                                    <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Company Prefix*</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="prefix" type="text" value="{{@$data->prefix}}"
                                                        class="form-control @error('prefix') is-invalid @enderror" placeholder="Enter Prefix">
                                                </div>
                                                @error('prefix')
                                                    <div class="invalid-feedback" style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">P.I. Prefix</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="pi_prefix" type="text" value="{{@$data->pi_prefix}}"
                                                        class="form-control" placeholder="Enter P.I. Prefix">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Invoice Prefix</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="invoice_prefix" type="text"
                                                        value="{{@$data->invoice_prefix}}" class="form-control"
                                                        placeholder="Enter Invoice Prefix">
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
                                                <label class="form-label">Address</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="address"
                                                        class="form-control">{{@$data->address}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <br>
                                        {{-- <button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button> --}}
                                        <button class="btn btn-success btn-cons ajaxFormSubmitAlter"
                                            type="submit">Submit</button>
                                            
                                        <a href="{{route('company.view')}}" class="btn btn-default btn-cons"
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#fileUploader').fileuploader({
            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<img src="{{ asset("assets/admin/myplugin/fileuploader/images/fileuploader-dragdrop-icon.png") }}">' +
                '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                '<p>or</p>' +
                '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                '</div>' +
                '</div>',
            theme: 'dragdrop',
            limit: 2,
            addMore: true,
            extensions: ['jpg', 'jpeg', 'png'],
            onRemove: function (item) {
                $.post('{{route("company.image.delete.logo")}}', {
                    file: item.name,
                    data: {
                        image_file_id: "{{ @$data->id }}",
                        file: item.name,
                        image_post_file_id: item.data.image_file_id,
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    }
                });
            },
            captions: {
                feedback: 'Drag and drop files here',
                feedback2: 'Drag and drop files here',
                drop: 'Drag and drop files here'
            },
        });
        $('#fileUploader2').fileuploader({
            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<img src="{{ asset("assets/admin/myplugin/fileuploader/images/fileuploader-dragdrop-icon.png") }}">' +
                '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                '<p>or</p>' +
                '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                '</div>' +
                '</div>',
            theme: 'dragdrop',
            limit: 2,
            addMore: true,
            extensions: ['jpg', 'jpeg', 'png'],
            onRemove: function (item) {
                $.post('{{route("company.image.delete.header")}}', {
                    file: item.name,
                    data: {
                        image_file_id: "{{ @$data->id }}",
                        file: item.name,
                        image_post_file_id: item.data.image_file_id,
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    }
                });
            },
            captions: {
                feedback: 'Drag and drop files here',
                feedback2: 'Drag and drop files here',
                drop: 'Drag and drop files here'
            },
        });
        $('#fileUploader3').fileuploader({
            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<img src="{{ asset("assets/admin/myplugin/fileuploader/images/fileuploader-dragdrop-icon.png") }}">' +
                '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                '<p>or</p>' +
                '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                '</div>' +
                '</div>',
            theme: 'dragdrop',
            limit: 2,
            addMore: true,
            extensions: ['jpg', 'jpeg', 'png'],
            onRemove: function (item) {
                $.post('{{route("company.image.delete.footer")}}', {
                    file: item.name,
                    data: {
                        image_file_id: "{{ @$data->id }}",
                        file: item.name,
                        image_post_file_id: item.data.image_file_id,
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    }
                });
            },
            captions: {
                feedback: 'Drag and drop files here',
                feedback2: 'Drag and drop files here',
                drop: 'Drag and drop files here'
            },
        });


    });

</script>
@endsection
