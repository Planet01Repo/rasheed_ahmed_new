@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE CONTAINER-->
<style>
    .select2-container
    {
        width:100% !important;
    }
</style>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb">
      <li>
        <p>Dashboard</p>
      </li>
      <li>
        Product
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
            <form class="ajaxForm validate" action="{{route('purchase_order.post')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label my-label-style">Supplier</label>

                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select <?= (isset($data->id)) ? 'disabled="true"' : '' ?> class="form-control select2" id="supplier_id" name="supplier_id">
                            <option value="" selected="" disabled="">-- Select Supplier --</option>
                            @foreach ($supplier as $k => $v)
                            <option value="{{$v->id}}"  {{($v->id == @$data->supplier_id) ? 'selected' : '' }}>
                              {{ $v->name }}
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
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Purchase Order Date</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input id="date" name="date"  type="text" value="<?=  @$data->date; ?>" class="form-control datepicker2" placeholder="Enter Purchase Order Date">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Purchase Order No</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input id="po_no" name="po_no" type="text" value="<?=  @$data->po_no; ?>" class="form-control" placeholder="Enter Purchase Order No">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <!--<div class="clearfix"></div>-->
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Import No</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input id="import_no" name="import_no"  type="text" value="<?= @$data->import_no; ?>" class="form-control" placeholder="Enter Import No">
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
                          <input  name="payment_terms"  type="text" value="<?= @$data->payment_terms; ?>" class="form-control" placeholder="Enter Payment Terms">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Shipping Method</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select name="shipping_method" style="width:100px"  class="select2 mb-3" required>
                              <option selected disabled>--- Select Shipping Method ---</option>
                              <?php
                                      $shipData = shippping_method();
                                      foreach ($shipData as $k2 => $v2) {
                                      ?>
                                        <option <?= ($k2 == @$data->shipping_method) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                      <?php } ?>
                          </select>
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
                        <label class="form-label">Price Base</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select name="price_base" style="width:100px"  class="select2 mb-3" required>
                              <option selected disabled>--- Select Price Base ---</option>
                              <?php
                                      $priceData = price_base();
                                      foreach ($priceData as $k2 => $v2) {
                                      ?>
                                        <option <?= ($k2 == @$data->price_base) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                      <?php } ?>
                          </select>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label">Remarks/Instructions</label>
                      </div>
                      <div class="col-md-12">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <textarea name="notes" type="textarea" id="myeditor" class="editor form-control" placeholder="Enter Notes">{!! @$data->notes !!}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="responsive-scroll" style="width: 100%;">
                        <table class="table table-bordered" style="overflow-x:scroll">
                          <thead>
                            <tr>
                              <th class="text-center">Add/Remove Row</th>
                              <th class="text-center">PO Material</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Unit</th>
                              <th class="text-center">Rate</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tr class="txtMult">
                            <td class="text-center"><a href="javascript:void(0);" class="addCF">Add</a></td>
                            <td colspan="5"></td>
                          </tr>

                          <tbody id="customFields">

                            @php($k = 1)
                            @if(!empty(@$data->id) && @$data->id != null)
                            @foreach(@$detail_data as $v)
                            <tr class="txtMult">
                              <td class="text-center" style="width:40px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>

                              <td>
                                <select name="po_material_id[]" style="width:100px" id="po_material_id{{ $k }}" class="select2 po_material_id mb-3" required>
                                  <option selected disabled>--- Select PO Material ---</option>
                                  @foreach ($material_data as $km => $vm)
                                  <option value="{{$vm->id}}"  {{($vm->id == @$v->po_material_id) ? 'selected' : '' }} data-unit = "{{ $vm['unit']}}" data-rate = "{{ $vm['price']}}">
                                    {{ $vm->name }}
                                  </option>
                                  @endforeach
                              </td>

                              

                              <td>
                                <input type='text' class='txtboxToFilter quantity' value="{{@$v->quantity}}" required style='width:100%' id='quantity{{ $k }}' data-optional='0' name='quantity[]' />
                              </td>

                              <td>
                                  <select name="unit[]" class="unit select2">
                                      <option selected disabled>--- Select Measurement ---</option>
                                      <?php
                                      $measureData = measurementUnit();
                                      foreach ($measureData as $k2 => $v2) {
                                      ?>
                                        <option <?= ($k2 == @$v->unit) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                      <?php } ?>
                                </select>
                              </td>

                              <td>
                                <input type='text' readonly class='allow_decimal rate' value="{{@$v->rate}}" required  style='width:100%' id='rate{{ $k }}' data-optional='0' name='rate[]' />
                              </td>
                              
                              <td>
                                  <input type='text' readonly class='allow_decimal total' value="{{ number_format(@$v->rate*@$v->quantity,2)}}" required  style='width:100%' id='total{{ $k }}' data-optional='0' name='total[]' />
                              </td>
                              
                            
                              
                              

                            </tr>
                            @php($k ++)
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
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
    
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $(".datepicker2").datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    //   startDate: today
    });
    // $('.datepicker2').datepicker('setDate', today);
    $.validator.addMethod(
      "check_duplicate",
      function(value, element) {
        
        var timeRepeated = 0;
        
        $('#customFields tr.txtMult').each(function() {
            var row = $(this).closest('tr');
            var product_id = row.find('.po_material_id option:selected').val();
          if (product_id === value ) {
            timeRepeated++;
          }
        });
        
        if (timeRepeated === 1 || timeRepeated === 0) {
          return true
        } else {
          return false
        }
      },

    );
    $("form.validate").validate({
      rules: {
        supplier_id:{
           required: true
         },
         date:{
           required: true
         },
         po_no:{
           required: true
         },
         quantity:{
           required: true
         },
        "po_material_id[]": {
          required: true,
          check_duplicate: true
        },
         
      },
      messages: {
        "po_material_id[]": {
          required: "This field is required.",
          check_duplicate: "Duplicate value entered."
        }
      },
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
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    
 
    

  var x = 0;
  var add_button = $(".addCF");
  $(add_button).click(function(e) {
    
    
    x++;
    e.preventDefault();
    $('form.validate').validate();
    var temp = '<tr class="txtMult">';
    temp += '<td class="text-center" style="width:60px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>';

    temp += '<td>';
    temp += '<select name="po_material_id[]" style="width:100px" id="po_material_id' + x + '"  class="select2 po_material_id mb-3" required>';
    temp    += '<option selected disabled>--- Select PO Material ---</option>';
    temp    += '<?php foreach($material_data as $k => $v){ ?><option data-unit = "<?= $v['unit']?>" data-rate = "<?= $v['price']?>"';
    temp    += ' value="<?= $v['id']; ?>"><?= $v['name']; ?></option><?php } ?>';

    temp += '</select> ';
    temp += "</td>";

   

    temp += '<td>';
    temp += "<input type='text' class='txtboxToFilter quantity' required  style='width:100%' id='quantity" + x + "' data-optional='0' name='quantity[]' />";
    temp += '</td>';

    temp += '<td>';
    temp += '<select name="unit[]" class="unit" disabled="true" id="unit' + x + '" >';
    temp += '<option selected disabled>--- Select unit ---</option>';
    <?php
    $measureData = measurementUnit();
    foreach ($measureData as $k2 => $v2) {
    ?>
      temp += '<option value="<?= $k2 ?> "><?= $v2 ?></option>';
    <?php } ?>
    temp += '</select>';
    temp += '</td>';

    temp += '<td>';
    temp += "<input type='text' readonly class='allow_decimal rate' required  style='width:100%' id='rate" + x + "' data-optional='0' name='rate[]' />";
    temp += '</td>';
    
    
    temp += '<td>';
    temp += "<input type='text' readonly class='allow_decimal total' required  style='width:100%' id='total" + x + "' data-optional='0' name='total[]' />";
    temp += '</td>';


    
    temp += '</tr>';

    $("#customFields").append(temp);
    $("#po_material_id" + x).select2();
    $("#unit" + x).select2();

  });

  $("#customFields").on('click', '.remCF', function() {
    $(this).parent().parent().remove();
  });

  
  $(document).on('change', ".po_material_id", function() {
    var row = $(this).closest('tr');
   
    var unit = row.find('.po_material_id option:selected').attr("data-unit");
    var rate = row.find('.po_material_id option:selected').attr("data-rate");

    
    row.find('.rate').val(rate);
    row.find('select.unit').empty();
    
    <?php
    $measureData = measurementUnit();
    foreach ($measureData as $k2 => $v2) {
    ?>
        if(<?= $k2 ?> == unit)
        {
            row.find('select.unit').append('<option value="<?= $k2 ?> "><?= $v2 ?></option>');        
        }
      
    <?php } ?>
    
    row.find('select.unit').trigger('change');
    
  });

  $(document).on('keyup', ".quantity", function(e) {
  
      var row = $(this).closest('tr');
      var rate = parseFloat(row.find('.po_material_id option:selected').attr("data-rate"));
      var quantity = parseFloat(row.find('.quantity').val());
      var total = quantity*rate;
      row.find('.total').val(total);
      
  });
  
  $(document).on('keypress', ".only_num", function(e) {
    var x = e.which || e.keycode;
    if ((x >= 48 && x <= 57)) {
      return true;
    } else {
      e.preventDefault();
      return false;
    }
  });
</script>
@endsection