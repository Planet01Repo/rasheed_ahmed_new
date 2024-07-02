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
        <li><a href="#" class="active">{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}}</a> </li>
      </ul>
        <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border"> 
                  <h4>{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}} <span class="semi-bold">Form</span></h4>
                </div>
                <div class="grid-body no-border">
                  <form class="ajaxForm validate" action="{{route('po_material.post')}}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Name</label>
                              </div>
                              <div class="col-sm-12 col-md-12">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="name"  type="text" value="{{@$data->name}}"  class="form-control" placeholder="Enter Material Name">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Description</label>
                              </div>
                              <div class="col-sm-12 col-md-12">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="description"  type="text" value="{{@$data->description}}"  class="form-control" placeholder="Enter Description">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Code</label>
                              </div>
                              <div class="col-sm-12 col-md-12">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="code"  type="text" value="{{@$data->code}}"  class="form-control" placeholder="Enter Code">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Price</label>
                              </div>
                              <div class="col-sm-12 col-md-12">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="price"  type="text" value="{{@$data->price}}"  class="form-control allow_decimal" placeholder="Enter Price">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>
                      
                       <div class="col-md-6">
                          <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label"> Unit</label>
                              </div>
                              <div class="col-sm-12 col-md-9">
                                <div class="input-with-icon right controls">
                                  <i class=""></i>
                                  <select name="unit" class="unit select2 form-control">
                                              <option selected disabled>--- Select Measurement ---</option>
                                              <?php
                                              $measureData = measurementUnit();
                                              foreach ($measureData as $k2 => $v2) {
                                              ?>
                                                <option <?= ($k2 == @$data->unit) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
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
                          </br><button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button>
                          <input name="id"  type="hidden" value="{{ @$data->id }}">
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
        name:{
          required: true
        },
        price:{
          required: true
        },
        code:
        {
          required: true
        }
       /* prefix:{
          required: true
        },*/
      }, 
      messages: {
      },
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
</script>
@endsection