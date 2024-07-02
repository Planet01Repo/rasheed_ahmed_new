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
          Supplier
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
                  <form class="ajaxForm validate" action="{{route('supplier.post')}}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Name</label>
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="name"  type="text" value="{{@$data->name}}"  class="form-control" placeholder="Enter Name">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <div class="row ">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label">Email</label>
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="email"  type="text" value="{{@$data->email}}"  class="form-control" placeholder="Enter Email">
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
                                <label class="form-label">Phone</label>
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="contact_no"  type="text" value="{{@$data->contact_no}}"  class="form-control txtboxToFilter" placeholder="Enter Phone">
                                  </div>
                                
                              </div>
                            </div>
                        </div>
                      </div>
                      
                        <div class="col-md-6">
                        <div class="form-group">
                            <div class="row form-row">
                              <div class="col-sm-12 col-md-12">
                                <label class="form-label my-label-style"> Company Name</label>
                                 
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input name="company_name"  type="text" value="{{@$data->company_name}}"  class="form-control" placeholder="Enter Customer Company Name">
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
                                <label class="form-label">Company Address</label>
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <textarea  name="company_address" class="form-control">{{@$data->company_address}}</textarea>
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
                                <label class="form-label my-label-style">Status</label>
                                 
                              </div>
                              <div class="col-sm-12 col-md-9">
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <select class="form-control input-signin-mystyle select2" id="currency" name="currency">
                                      <option value="" selected="selected" disabled="">- Select Currency -</option>
                                      <?php
                                      $currency = currency();
                                      foreach ($currency as $k2 => $v2) {
                                      ?>
                                        <option <?= ($k2 == @$v->currency) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
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
        contact_no:{
          required: true
        },
        company_name:{
          required: true
        },
        company_address:{
          required: true
        }
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