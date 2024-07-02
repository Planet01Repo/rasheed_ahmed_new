@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li>
                <p>Dashboard</p>
            </li>

            <li><a href="#" class="active">{{isset($data->id) ? 'Edit' : ''}} {{(isset($title)) ? $title : ''}}</a> </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title no-border">
                        <h4>{{isset($data->id) ? 'Edit' : ''}} {{(isset($title)) ? $title : ''}} <span class="semi-bold">Form</span></h4>
                    </div>
                    <div class="grid-body no-border">
                        <form class="ajaxForm validate" action="{{route('delete.post')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row ">
                                        <div class="col-sm-12 col-md-12">
                                            <label class="form-label">Tables</label>
                                        </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="size" value="1"  class="form-check-input" id="size">
                                                        <label class="form-check-label" for="size">Size</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="product" value="1"  class="form-check-input" id="product">
                                                        <label class="form-check-label" for="product">Product</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="product_material" value="1"  class="form-check-input" id="product_material">
                                                        <label class="form-check-label" for="product_material">Product Material</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="product_size" value="1"  class="form-check-input" id="product_size">
                                                        <label class="form-check-label" for="product_size">Product Size</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="perfoma_invoice" value="1"  class="form-check-input" id="perfoma_invoice">
                                                        <label class="form-check-label" for="perfoma_invoice">Perfoma Invoice</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="perfoma_invoice_detail" value="1"  class="form-check-input" id="perfoma_invoice_detail">
                                                        <label class="form-check-label" for="perfoma_invoice_detail">Perfoma Invoice Detail</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="material" value="1"  class="form-check-input" id="material">
                                                        <label class="form-check-label" for="material">Material</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="images" value="1"  class="form-check-input" id="images">
                                                        <label class="form-check-label" for="images">Images</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="customer" value="1"  class="form-check-input" id="customer">
                                                        <label class="form-check-label" for="customer">Customer</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="country" value="1"  class="form-check-input" id="country">
                                                        <label class="form-check-label" for="country">Countries</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="company" value="1"  class="form-check-input" id="company">
                                                        <label class="form-check-label" for="company">Company</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <div class="form-check checkbox">
                                                        <input type="checkbox" name="carton" value="1"  class="form-check-input" id="carton">
                                                        <label class="form-check-label" for="carton">Carton</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="col-md-6">
                        <div class="form-group">
                            <div class="row form-row">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label my-label-style">Status</label>
                                 
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <select class="form-control input-signin-mystyle select2" id="category_is_active" name="category_is_active">
                                      <option value="" selected="selected" disabled="">- Select Status -</option>
                                      <option value="1" <?= (!isset($data->id)) ? 'selected' : '' ?> <?= (@$data['category_is_active'] == 1) ? 'selected' : ''; ?> >Enabled</option>
                                      <option value="0" <?= (@$data['category_is_active'] == 0 && isset($data->id)) ? 'selected' : ''; ?>>Disabled
                                      </option>
                                    </select>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div> -->

                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        </br><button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button>
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
    $(document).ready(function() {
        $("form.validate").validate({
            rules: {
                name: {
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