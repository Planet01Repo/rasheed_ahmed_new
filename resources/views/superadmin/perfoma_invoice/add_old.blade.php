@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE CONTAINER-->
<style>
    .select2-container {
        width: 100% !important;
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
                        <form class="ajaxForm validate" action="{{route('perfoma_invoice.post')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label my-label-style">Customer</label>

                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <select <?= (isset($data->id)) ? 'disabled="true"' : '' ?>
                                                        class="form-control select2" id="customer_id"
                                                        name="customer_id">
                                                        <option value="" selected="" disabled="">-- Select Customer --
                                                        </option>
                                                        @foreach ($customer as $k => $v)
                                                        <option value="{{$v->id}}"
                                                            data-prefix="{{ $v->company->prefix }}"
                                                            {{($v->id == @$data->customer_id) ? 'selected' : '' }}>
                                                            {{ $v->customer_company_name }}
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
                                                <label class="form-label">PI Date</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input class="form-control datepicker" type="text" id="pi_date"
                                                        name="pi_date" value="<?= @$data->pi_date; ?>"
                                                        placeholder="pi_date">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style='display:none'>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Proforma Invoice No</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input class="perfoma_no" type="hidden"
                                                        value="<?= perfoma_invoice_no(); ?>">
                                                    <input id="perfoma_invoice_no" name="perfoma_invoice_no" type="text"
                                                        readonly
                                                        value="<?= (!isset($data->id)) ? '-' . perfoma_invoice_no() : @$data->perfoma_invoice_no; ?>"
                                                        class="form-control" placeholder="Enter Invoice No">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="clearfix"></div>-->

                                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Proforma Invoice No Local</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input id="perfoma_invoice_no_local" name="perfoma_invoice_no_local"  type="text" value="<?= @$data->perfoma_invoice_no_local; ?>" class="form-control" placeholder="Enter Local Invoice No">
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}

                                <div class="clearfix"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Customer PO Number</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="po_number" type="text"
                                                        value="<?= @$data->po_number; ?>" class="form-control"
                                                        placeholder="Enter Customer PO Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Shipped Per</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="shipped_per" type="text"
                                                        value="<?= @$data->shipped_per; ?>" class="form-control"
                                                        placeholder="Enter Shipped Per">
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
                                                <label class="form-label">BL / AWB No</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="awb_no" type="text" value="" class="form-control"
                                                        placeholder="Enter BL / AWB No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">BL / AWB Date</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="awb_date" type="text" value=""
                                                        class="form-control datepicker" placeholder="Enter BL / AWB Date">
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
                                                <label class="form-label">Form E No</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="form_no" type="text" value="" class="form-control"
                                                        placeholder="Enter Form E Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="form-label">Form E Date</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <input name="form_date" type="text" value=""
                                                        class="form-control datepicker" placeholder="Enter Form E Date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--                 
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
                                      // $priceData = price_base();
                                      // foreach ($priceData as $k2 => $v2) {
                                      // ?>
                                      //   <option <?= ($k2 == @$data->price_base) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                      <?php } ?>
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
                        <label class="form-label">To</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input  name="to"  type="text" value="<?= @$data->to; ?>" class="form-control" placeholder="Enter to whom invoice is for">
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
                        <label class="form-label">Marks No 1</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input  name="marks_no_1"  type="text" value="<?= @$data->marks_no_1; ?>" class="form-control" placeholder="Enter Mark & No Line 1">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Marks No 2</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input  name="marks_no_2"  type="text" value="<?= @$data->marks_no_2; ?>" class="form-control" placeholder="Enter Mark & No Line 2">
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
                        <label class="form-label">Marks No 3</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input  name="marks_no_3"  type="text" value="<?= @$data->marks_no_3; ?>" class="form-control" placeholder="Enter Mark & No Line 3">
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}

                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-3">
                                                <label class="form-label">Europe Declaration</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="europe_shipment" type="textarea"
                                                        class="form-control"
                                                        placeholder="Enter Europe Declaration">{!! @$data->europe_shipment !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                                <label class="form-label">Customer Specific Details</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="customer_specific" type="textarea"
                                                        class="form-control"
                                                        placeholder="Enter Customer Specific Details">{!! @$data->customer_specific !!}</textarea>
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
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-with-icon right controls">
                                                    <i class=""></i>
                                                    <textarea name="description" type="textarea" id="myeditor"
                                                        class="editor form-control"
                                                        placeholder="Enter Description">{!! @$data->description !!}</textarea>
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
                                                <table class="table table-bordered"
                                                    style="display:block; overflow-x:scroll">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width:60px;">Add/Remove Row
                                                            </th>
                                                            <th class="text-center" style="min-width:200px;">Product
                                                            </th>
                                                            <th class="text-center" style="min-width:200px;">Size</th>
                                                            <th class="text-center" style="min-width:200px;">Quantity
                                                            </th>
                                                            <th class="text-center" style="min-width:200px;">Unit</th>
                                                            <th class="text-center" style="min-width:200px;">Cartons
                                                            </th>
                                                            <th class="text-center" style="min-width:200px;">Article
                                                                Rate</th>
                                                            <th class="text-center" style="min-width:200px;">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tr class="txtMult">
                                                        <td class="text-center"><a href="javascript:void(0);"
                                                                class="addCF">Add</a></td>
                                                        <td colspan="8"></td>
                                                    </tr>

                                                    <tbody id="customFields">

                                                        @php($k = 1)
                                                        @if(!empty(@$data->id) && @$data->id != null)
                                                        @foreach(@$detail_data as $v)
                                                        <tr class="txtMult">
                                                            <td class="text-center" style="width:40px;"><a
                                                                    href="javascript:void(0);" class="remCF">Remove</a>
                                                            </td>

                                                            <td>
                                                                <select name="product_id[]" style="width:100px"
                                                                    id="product_id{{ $k }}"
                                                                    class="select2 product_id mb-3" required>
                                                                    <option selected disabled>--- Select Product ---
                                                                    </option>
                                                                    <option selected value="{{ $v->product['id'] }}"
                                                                        data-article-rate="{{ $v->product['article_rate'] }}"
                                                                        data-outer-carton-dm="{{ $v->product['master_carton_dimension'] }}"
                                                                        data-outer-carton="{{ $v->product['master_carton'] }}"
                                                                        data-inner-carton-dm="{{ $v->product['inner_carton_dimension'] }}"
                                                                        data-inner-carton="{{ $v->product['inner_carton'] }} "
                                                                        data-bundle-pack="{{ $v->product['bundle_packing'] }} "
                                                                        data-individual-pack="{{ $v->product['individual_packing'] }}"
                                                                        data-unit="{{ $v->product['unit'] }}">
                                                                        {{ $v->product['name'] }}</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <select name="size_id[]" style="width:100px"
                                                                    id="size{{ $k }}" class="select2 size_id mb-3"
                                                                    required>
                                                                    <option selected disabled>--- Select Size ---
                                                                    </option>
                                                                    <option selected value="{{$v->size['id']}}">
                                                                        {{$v->size['name']}}</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <input type='text' class='txtboxToFilter quantity'
                                                                    value="{{@$v->quantity}}" required
                                                                    style='width:100%' id='quantity{{ $k }}'
                                                                    data-optional='0' name='quantity[]' />
                                                            </td>

                                                            <td>
                                                                <select name="unit[]" class="unit select2">
                                                                    <option selected disabled>--- Select Measurement ---
                                                                    </option>
                                                                    <?php
                                      $measureData = measurementUnit();
                                      foreach ($measureData as $k2 => $v2) {
                                      ?>
                                                                    <option <?= ($k2 == @$v->unit) ? 'selected' : ''; ?>
                                                                        value='<?= $k2 ?>'><?= $v2 ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <div class="input-with-icon right controls">
                                                                    <i class=""></i>
                                                                    <input type='text' readonly
                                                                        class='txtboxToFilter carton'
                                                                        value="{{@$v->carton}}" required
                                                                        style='width:100%' id='carton{{ $k }}'
                                                                        data-optional='0' name='carton[]' />
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <input type='text' readonly
                                                                    class='allow_decimal article_rate'
                                                                    value="{{@$v->article_rate}}" required
                                                                    style='width:100%' id='article_rate{{ $k }}'
                                                                    data-optional='0' name='article_rate[]' />
                                                            </td>

                                                            <td>
                                                                <input type='text' readonly class='allow_decimal total'
                                                                    value="{{@$v->article_rate * @$v->quantity}}"
                                                                    required style='width:100%' id='total{{ $k }}'
                                                                    data-optional='0' name='total[]' />
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
                                        </br><button class="btn btn-success btn-cons ajaxFormSubmitAlter"
                                            type="button">Submit</button>
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

        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        });
        var product_data;
        var check = '<?= @$data->id; ?>';
        if (check != '') {
            console.log('Edit');
            var customer_id = $('#customer_id').val();
            var promises = [];

            var request = $.ajax({
                url: '{{route("perfoma_invoice.customer_product")}}',
                dataType: "json",
                type: "POST",
                data: {
                    customer_id: customer_id
                },
                cache: false,
                success: function (result) {

                    product_data = result['data'];

                }
            });
            promises.push(request);

            $.when.apply(null, promises).done(function () {

                $('.product_id').trigger('change');
            });

        }

        $.validator.addMethod(
            "check_duplicate",
            function (value, element) {

                var size = $(element).closest('tr').find('.size_id option:selected').val();
                // console.log('carton: '+size);
                var timeRepeated = 0;

                $('#customFields tr.txtMult').each(function () {
                    var row = $(this).closest('tr');
                    var product_id = row.find('.product_id option:selected').val();
                    var size_id = row.find('.size_id option:selected').val();
                    if (product_id === value && size === size_id) {
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
        $.validator.addMethod(
            "check_carton",
            function (value, element) {


                var timeRepeated = 0;

                $('#customFields tr.txtMult').each(function () {
                    var row = $(this).closest('tr');
                    var master_carton = row.find('.product_id option:selected').attr(
                        "data-individual-pack");
                    var quantity = row.find('.quantity').val();
                    if (quantity % master_carton != 0) {
                        timeRepeated++;
                    }

                });

                if (timeRepeated == 0) {
                    return true
                } else {
                    return false
                }
            },

        );
        $("form.validate").validate({
            rules: {
                customer_id: {
                    required: true
                },
                //  perfoma_invoice_no_local:{
                //    required: true
                //  },
                "product_id[]": {
                    required: true,
                    check_duplicate: true
                },
                "carton[]": {
                    required: true,
                    check_carton: true
                },
                /* 
                stitching_rate_a:{
                  required: true,
                  digits: true
                },
                stitching_rate_b:{
                  required: true,
                  digits: true
                },
                commission_rate:{
                  required: true,
                  digits: true
                },
                elastic_commission_rate:{
                  required: true,
                  digits: true
                },
                magzi_commission_rate:{
                  required: true,
                  digits: true
                },*/
            },
            messages: {
                "product_id[]": {
                    required: "This field is required.",
                    check_duplicate: "Duplicate value entered."
                },
                "carton[]": {
                    required: "This field is required.",
                    check_carton: "Invalid quantity."
                }
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', "#customer_id", function () {
        var count = 0;
        $("tr.txtMult").each(function () {
            count++;
        });
        if (count > 1) {
            swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        fetch_customer_product();

                    } else {
                        return false;
                    }
                });
        } else {

            fetch_customer_product();
        }


    });

    function fetch_customer_product() {
        var perfoma_invoice_no = $('.perfoma_no').val();
        var prefix = $('#customer_id').find(':selected').attr("data-prefix");
        $('#perfoma_invoice_no').val(prefix + '-' + perfoma_invoice_no);
        var customer_id = $('#customer_id').find(':selected').val();
        $.ajax({
            url: '{{route("perfoma_invoice.customer_product")}}',
            dataType: "json",
            type: "POST",
            data: {
                customer_id: customer_id
            },
            cache: false,
            success: function (result) {

                $("#customFields").html('');
                product_data = result['data'];
                var temp = '';
                var x = 0;
                // for (var i = 0; i < result['data'].length; i++) {
                //   for (var j = 0; j < result['data'][i]['productsize'].length; j++) {
                //     x++;
                //     temp = '<tr class="txtMult">';
                //     temp += '<td class="text-center" style="width:40px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>';

                //     temp += '<td>';
                //     temp += '<select name="product_id[]" style="width:100px" id="product_id' + x + '" class="select2 product_id mb-3" required>';
                //     temp += '<option selected disabled>--- Select Product ---</option>';
                //     temp += '<option selected value= "' + result['data'][i]['id'] + '">' + result['data'][i]['name'] + '</option> ';
                //     temp += '</select> ';
                //     temp += "</td>";

                //     temp += '<td>';
                //     temp += '<select name="size_id[]" style="width:100px" id="size' + x + '" class="select2 size_id mb-3" required>';
                //     temp += '<option selected disabled>--- Select Size ---</option>';
                //     temp += '<option selected value= "' + result['data'][i]['productsize'][j]['size_id'] + '">' + result['data'][i]['productsize'][j]['size']['name'] + '</option> ';
                //     temp += '</select> ';
                //     temp += '</td>';

                //     temp += '<td>';
                //     temp += "<input type='text' class='txtboxToFilter quantity' required  style='width:100%' id='quantity" + x + "' data-optional='0' name='quantity[]' />";
                //     temp += '</td>';

                //     temp += '<td>';
                //     temp += "<input type='text' class='txtboxToFilter unit' required  style='width:100%' id='unit" + x + "' data-optional='0' name='unit[]' />";
                //     temp += '</td>';

                //     temp += '<td>';
                //     temp += "<input type='text' class='txtboxToFilter pack' required  style='width:100%' id='pack" + x + "' data-optional='0' name='pack[]' />";
                //     temp += '</td>';

                //     temp += '<td>';
                //     temp += "<input type='text' class='txtboxToFilter ctn' required  style='width:100%' id='ctn" + x + "' data-optional='0' name='ctn[]' />";
                //     temp += '</td>';

                //     temp += '</tr>';

                //     $("#customFields").append(temp);
                //     $("#product_id" + x).select2();
                //     $("#size" + x).select2();
                //   }

                // }



            }
        });
    }

    //   var product_data = '{!! json_encode($product_data) !!}';
    //   product_data = JSON.parse(product_data);
    var x = 0;
    var add_button = $(".addCF");
    $(add_button).click(function (e) {
        var check = $('#customer_id').valid();
        if (!check) {
            return false;
        }

        x++;
        e.preventDefault();
        $('form.validate').validate();
        var temp = '<tr class="txtMult">';
        temp +=
            '<td class="text-center" style="width:60px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>';

        temp += '<td>';
        temp += '<select name="product_id[]" style="width:100px" id="product_id' + x +
            '"  class="select2 product_id mb-3" required>';
        temp += '<option selected disabled>--- Select Product ---</option>';
        for (var n = 0; n < product_data.length; n++) {
            temp += '<option value="' + product_data[n].id + '" data-article-rate="' + product_data[n]
                .article_rate + '" data-outer-carton-dm="' + product_data[n].master_carton_dimension +
                '" data-outer-carton="' + product_data[n].master_carton + '" data-inner-carton-dm="' +
                product_data[n].inner_carton_dimension + '" data-inner-carton="' + product_data[n]
                .inner_carton + '" data-bundle-pack="' + product_data[n].bundle_packing +
                '" data-individual-pack="' + product_data[n].individual_packing + '" data-unit="' +
                product_data[n].unit + '" >';
            temp += product_data[n].name;
            temp += '</option>';
        }
        temp += '</select> ';
        temp += "</td>";

        temp += '<td>';
        temp += '<select name="size_id[]" style="width:100px" id="size' + x +
            '" class="select2 size_id mb-3" required>';
        temp += '<option selected disabled>--- Select Size ---</option>';
        temp += '</select> ';
        temp += '</td>';

        temp += '<td>';
        temp += "<input type='text' class='txtboxToFilter quantity' required  style='width:100%' id='quantity" +
            x + "' data-optional='0' name='quantity[]' />";
        temp += '</td>';

        temp += '<td>';
        temp += '<select name="unit[]" class="unit" disabled="true" id="unit' + x + '" >';
        temp += '<option selected disabled>--- Select unit ---</option>'; <
        ? php
        $measureData = measurementUnit();
        foreach($measureData as $k2 => $v2) {
                ?
                >
                temp += '<option value="<?= $k2 ?> "><?= $v2 ?></option>'; <
                ? php
            } ? >
            temp += '</select>';
        temp += '</td>';

        temp += '<td>';
        temp +=
            "<input type='text' readonly class='allow_decimal carton' required  style='width:100%' id='carton" +
            x + "' data-optional='0' name='carton[]' />";
        temp += '</td>';

        temp += '<td>';
        temp +=
            "<input type='text' readonly class='allow_decimal article_rate' required  style='width:100%' id='article_rate" +
            x + "' data-optional='0' name='article_rate[]' />";
        temp += '</td>';

        temp += '<td>';
        temp +=
            "<input type='text' readonly class='allow_decimal total' required  style='width:100%' id='total" +
            x + "' data-optional='0' name='total[]' />";
        temp += '</td>';



        temp += '</tr>';

        $("#customFields").append(temp);
        $("#product_id" + x).select2();
        $("#size" + x).select2();
        $("#unit" + x).select2();

    });

    $("#customFields").on('click', '.remCF', function () {
        $(this).parent().parent().remove();
    });

    $(document).on('change keyup', ".quantity", function () {
        var row = $(this).closest('tr');
        var master_carton = row.find('.product_id option:selected').attr("data-individual-pack");
        var quantity = $(this).val();
        var article_rate = row.find('.product_id option:selected').attr("data-article-rate");
        var carton = quantity / master_carton;

        row.find('.carton').val(carton);
        row.find('.total').val(article_rate * quantity);

    });

    $(document).on('change', ".product_id", function () {
        var row = $(this).closest('tr');
        var product_id = row.find('.product_id option:selected').val();
        var master_carton = row.find('.product_id option:selected').attr("data-outer-carton");
        var master_carton_dm = row.find('.product_id option:selected').attr("data-outer-carton-dm");
        var inner_carton = row.find('.product_id option:selected').attr("data-inner-carton");
        var inner_carton_dm = row.find('.product_id option:selected').attr("data-inner-carton-dm");
        var bundle_pack = row.find('.product_id option:selected').attr("data-bundle-pack");
        var individual_pack = row.find('.product_id option:selected').attr("data-individual-pack");
        var unit = row.find('.product_id option:selected').attr("data-unit");
        var article_rate = row.find('.product_id option:selected').attr("data-article-rate");

        var master_crt_dm = '';
        var inner_crt_dm = ''; <
        ? php
        $cartonData = cartonData();
        foreach($cartonData as $k => $v) {
                ?
                >
                if (master_carton_dm == < ? = $k ? > ) {
                    master_crt_dm = "<?= $v; ?>";
                }
                if (inner_carton_dm == < ? = $k ? > ) {
                    inner_crt_dm = "<?= $v; ?>";
                }

                <
                ? php
            } ?
            >

            row.find('.master_ctn').val(master_carton);
        row.find('.master_ctn_dm').html(master_crt_dm);
        row.find('.inner_ctn').val(inner_carton);
        row.find('.inner_ctn_dm').html(inner_crt_dm);
        row.find('.bundle_pack').val(bundle_pack);
        row.find('.individual_pack').val(individual_pack);
        row.find('.article_rate').val(article_rate);

        row.find('select.unit').empty(); <
        ? php
        $measureData = measurementUnit();
        foreach($measureData as $k2 => $v2) {
                ?
                >
                if ( < ? = $k2 ? > == unit) {
                    row.find('select.unit').append('<option value="<?= $k2 ?> "><?= $v2 ?></option>');
                }

                <
                ? php
            } ? >

            row.find('select.unit').trigger('change');


        var temp = '';
        temp += '<option value="0" selected disabled>--- Select Size ---</option>';
        for (var n = 0; n < product_data.length; n++) {
            if (product_data[n].id == product_id) {
                for (var m = 0; m < product_data[n]['productsize'].length; m++) {
                    temp += '<option value="' + product_data[n]['productsize'][m]['size_id'] + '" >' +
                        product_data[n]['productsize'][m]['size']['name'] + '</option>';
                }
            }
        }

        row.find('select.size_id').empty();
        row.find('select.size_id').append(temp);
        row.find('select.size_id').trigger('change');

        row.find('.quantity').trigger('keyup');
    });

    $(document).on('keypress', ".only_num", function (e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    $(document).ready(function () {
        var date = new Date();

        var month = date.getMonth() + 1;
        var day = date.getDate();
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = month + "/" + day + "/" + year;
        $("#pi_date").attr("value", today);
    });

</script>
@endsection
