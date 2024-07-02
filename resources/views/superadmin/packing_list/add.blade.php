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
                <li><a href="#" class="active">{{ isset($data->id) ? 'Edit' : 'Add New' }}
                        {{ isset($title) ? $title : '' }}</a> </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="grid simple">
                        <div class="grid-title no-border">
                            <h4>{{ isset($data->id) ? 'Edit' : 'Add New' }} {{ isset($title) ? $title : '' }} <span
                                    class="semi-bold">Form</span></h4>
                        </div>
                        <div class="grid-body no-border">
                            {{-- <form class="ajaxForm validate" action="{{route('packing_list.post')}}" method="post" enctype="multipart/form-data"> --}}
                            <form class="" action="{{ route('packing_list.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row form-row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label my-label-style">Customer*</label>

                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <select <?= isset($data->id) ? 'disabled="true"' : '' ?>
                                                            class="form-control select2 @error('customer_id')
is-invalid
@enderror"
                                                            id="customer_id" name="customer_id">
                                                            <option value="" selected="" disabled="">-- Select
                                                                Customer --</option>
                                                            @foreach ($customer as $k => $v)
                                                                <option value="{{ $v->id }}"
                                                                    data-prefix="{{ $v->company->prefix }}"
                                                                    {{ $v->id == @$data->customer_id ? 'selected' : '' }}>
                                                                    {{ $v->customer_company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('customer_id')
                                                            <div class="invalid-feedback" style="color: red">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6" style='display:none'>
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Invoice No</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input class="perfoma_no" type="hidden" value="<?= packing_invoice_no() ?>">
                          <input id="invoice_no" name="invoice_no" type="text" readonly value="<?= !isset($data->id) ? '-' . packing_invoice_no() : @$data->invoice_no ?>" class="form-control" placeholder="Enter Invoice No">
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}

                                    <!--<div class="clearfix"></div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label">Local Invoice No*</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <select
                                                            class="form-control select2 @error('invoice_no') is-invalid @enderror"
                                                            name="invoice_creation_id" id="invoice_creation_id">
                                                            <option value="-1" selected>Select Invoice No</option>
                                                        </select>
                                                        @error('invoice_no')
                                                            <div class="invalid-feedback" style="color: red">
                                                                {{ $message }}</div>
                                                        @enderror
                                                        <input id="hidden_invoice_no" name="invoice_no" type="hidden"
                                                            value="{{ @$data->invoice_no }}">
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
                                                        <input name="awb_no" id="awb_no" type="text"
                                                            value="<?= @$data->awb_no ?>" class="form-control"
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
                                                    <label class="form-label">BL / AWB Date </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="awb_date" id="awb_date" type="text"
                                                            value="<?= @$data->awb_date ?>" class="form-control datepicker"
                                                            placeholder="Enter BL / AWB Date" readonly>
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
                                                    <label class="form-label">F.I NO</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="form_no" id="form_no" type="text"
                                                            value="<?= @$data->form_no ?>" class="form-control"
                                                            placeholder="Enter F.I NO">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label">F.I Date </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="form_date" id="form_date" type="text"
                                                            value="<?= @$data->form_date ?>"
                                                            class="form-control datepicker" placeholder="Enter Form Date"
                                                            readonly>
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
                                                    <label class="form-label">Shipping Method</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="shipped_per" id="shipped_per" type="text"
                                                            value="{{ @$data->shipped_per }}" class="form-control"
                                                            placeholder="Enter Shipped Per">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label">Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input name="packing_list_date" id="packing_list_date"
                                                            type="date" value="{{ @$data->packing_list_date }}"
                                                            class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    {{-- <div class="col-md-12">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-md-6">
                        {{-- <label class="form-label">Europe Shipment</label> --}}
                                    {{-- <label class="form-label">Europe Declaration</label>
                      </div>
                      <div class="col-md-12">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <textarea name="europe_shipment" id="europe_shipment" type="textarea"  class="form-control" placeholder="Enter Europe Shipment" readonly>{!! @$data->europe_shipment !!}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}


                                    {{-- <div class="col-md-6">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-md-6">
                        <label class="form-label">Customer Specific Details</label>
                      </div>
                      <div class="col-md-12">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <textarea name="customer_specific" id="customer_specific" type="textarea"  class="form-control" placeholder="Enter Customer Specific">{!! @$data->customer_specific !!}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}

                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Description of Goods</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <textarea name="description" id="description" type="textarea" id="" class="editor form-control"
                                                            placeholder="Enter Description" readonly>{{ @$data->description }}</textarea>
                                                        {{-- <textarea name="description" type="textarea" id="myeditor" class="editor form-control" placeholder="Enter Description">{!! @$data->description !!}</textarea> --}}
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
                                                                {{-- <th class="text-center" style="width:60px;">Add/Remove Row</th> --}}
                                                                <th class="text-center" style="min-width:200px;">Product
                                                                </th>
                                                                <th class="text-center" style="min-width:200px;">Size</th>
                                                                <th class="text-center" style="min-width:200px;">Quantity
                                                                </th>
                                                                <th class="text-center" style="min-width:200px;">Pack</th>
                                                                <th class="text-center" style="min-width:200px;">Cartons
                                                                </th>
                                                                <th class="text-center" style="min-width:200px;">CBM</th>
                                                                <th class="text-center" style="min-width:200px;">Net
                                                                    Weight</th>
                                                                <th class="text-center" style="min-width:200px;">Gross
                                                                    Weight</th>
                                                            </tr>
                                                        </thead>
                                                        {{-- <tr class="txtMult">
                            <td class="text-center"><a href="javascript:void(0);" class="addCF">Add</a></td>
                            <td colspan="8"></td>
                          </tr> --}}

                                                        <tbody id="customFields">

                                                            @php($k = 1)
                                                            @if (!empty(@$data->id) && @$data->id != null)
                                                                @foreach (@$detail_data as $v)
                                                                    {{-- @dd($detail_data[0]->product->name) --}}
                                                                    <tr class="txtMult">
                                                                        <input type="hidden" name="product_id[]"
                                                                            value="{{ @$v->product_id }}" />
                                                                        <input type="hidden" name="size_id[]"
                                                                            value="{{ @$v->size_id }}" />
                                                                        <input type="hidden" class="unit_of_measurement"
                                                                            name="unit_of_measurement[]"
                                                                            value="{{ @$v->product->unit }}" />

                                                                        <td class="text-center"> <input type="text"
                                                                                value="{{ @$v->product->name }}"
                                                                                readonly /> </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                value="{{ @$v->size->name }}" readonly />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                class="quantity" name="quantity[]"
                                                                                value="{{ @$v->quantity }}" readonly />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                name="pack[]"
                                                                                value="{{ @$v->pack }}" readonly />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                class="carton"
                                                                                value="{{ @$v->carton }}" readonly />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                class="cbm"
                                                                                value="{{ @$v->cbm }}" />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                class="net_weight" name="net_weight[]"
                                                                                value="{{ @$v->net_weight }}" />
                                                                        </td>
                                                                        <td class="text-center"> <input type="text"
                                                                                class="gross_weight" name="gross_weight[]"
                                                                                value="{{ @$v->gross_weight }}" /> </td>
                                                                    </tr>
                                                                    {{-- <tr class="txtMult"> --}}
                                                                    {{-- <td class="text-center" style="width:40px;"><a href="javascript:void(0);" class="remCF">Remove</a></td> --}}

                                                                    {{-- <td>
                                <select name="product_id[]" style="width:100px" id="product_id{{ $k }}" class="select2 product_id mb-3" required>
                                  <option selected disabled>--- Select Product ---</option>
                                  <option selected value="{{ $v->product['id'] }}"
                                  data-article-rate="{{ $v->product['article_rate'] }}" data-outer-carton-dm="{{ $v->product['master_carton_dimension'] }}" data-outer-carton="{{ $v->product['master_carton'] }}" data-inner-carton-dm="{{ $v->product['inner_carton_dimension'] }}" data-inner-carton="{{ $v->product['inner_carton'] }} " data-bundle-pack="{{ $v->product['bundle_packing'] }} " data-individual-pack="{{ $v->product['individual_packing'] }}"
                                   data-unit="{{ $v->product['unit'] }}">{{ $v->product['name'] }}</option>
                                </select>
                              </td>

                              <td>
                                <select name="size_id[]" style="width:100px" id="size{{ $k }}" class="select2 size_id mb-3" required>
                                  <option selected disabled>--- Select Size ---</option>
                                  <option selected value="{{$v->size['id']}}">{{$v->size['name']}}</option>
                                </select>
                              </td>

                              <td>
                                <input type='text' class='txtboxToFilter quantity' value="{{@$v->quantity}}" required style='width:100%' id='quantity{{ $k }}' data-optional='0' name='quantity[]' />
                              </td>



                              <td>
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input type='text' readonly class='txtboxToFilter carton' value="{{@$v->carton}}" required  style='width:100%' id='carton{{ $k }}' data-optional='0' name='carton[]' />
                                  </div>
                              </td>

                              <td>
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input type='text' readonly class='cbm' value="{{@$v->cbm}}" required  style='width:100%' id='cbm{{ $k }}' data-optional='0' name='cbm[]' />
                                  </div>
                              </td>

                              <td>
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input type='text' readonly class='txtboxToFilter pack' value="{{@$v->pack}}" required  style='width:100%' id='pack{{ $k }}' data-optional='0' name='pack[]' />
                                  </div>
                              </td>

                              <td>
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input type='text' readonly class='allow_decimal net_weight' value="{{@$v->net_weight}}" required  style='width:100%' id='net_weight{{ $k }}' data-optional='0' name='net_weight[]' />
                                  </div>
                              </td>

                              <td>
                                  <div class="input-with-icon right controls">
                                    <i class=""></i>
                                    <input type='text' readonly class='allow_decimal gross_weight' value="{{@$v->gross_weight}}" required  style='width:100%' id='gross_weight{{ $k }}' data-optional='0' name='gross_weight[]' />
                                  </div>
                              </td>


                               --}}



                                                                    {{-- </tr> --}}
                                                                    @php($k++)
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        {{-- <thead>
                    <tr>Quantity</tr>
                  </thead> --}}
                                        <tbody id="custom">
                                            <tr class="txtMult">
                                                <th class="">Total Quantity</th>
                                                <td style="border-right: 1px solid rgb(192, 192, 192) !important;"><input
                                                        type="text" id="total_quantity" name="total_quantity"></td>
                                                <th class="">Total Carton</th>
                                                <td style="border-right: 1px solid rgb(192, 192, 192) !important;"><input
                                                        type="text" id="total_carton"></td>
                                                <th class="">Total CBM</th>
                                                <td><input type="text" id="total_cbm"></td>
                                                <th class="">Total Net Weight</th>
                                                <td><input type="text" id="total_net_weight"></td>
                                                <th class="">Total Gross Weight</th>
                                                <td><input type="text" id="total_gross_weight"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>


                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            </br>
                                            {{-- <button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button> --}}
                                            <button class="btn btn-success btn-cons" type="submit">Submit</button>
                                            <a href="{{ route('packing_list.view') }}"
                                                class="btn btn-default btn-cons">Back</a>

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
        function calculateQuantity() {
            var total = 0;
            $("#customFields tr.txtMult").each(function() {
                var row = $(this).closest('tr'); // get the row
                var unit = row.find('.unit_of_measurement').val();
                // console.log(unit);
                var quantity = row.find('.quantity').val();
                if (unit == 7) {
                    total = total + quantity / 2;
                    // total = total + (((val!='')? parseInt(val):0)/2);
                } else if (unit == 8) {
                    total = total + quantity * 12;
                    // console.log(total);
                } else {
                    total += parseInt(quantity, 10);
                }
                // console.log(days);
                // console.log(total);
            });
            // total += parseInt(quantity);

            $('#total_quantity').val(total.toFixed(2));
        }

        function calculateCarton() {
            var total_carton = 0;
            $("#customFields tr.txtMult").each(function() {
                var row = $(this).closest('tr');
                var carton = row.find('.carton').val();
                // console.log(carton);
                total_carton += parseInt(carton);
                // console.log(days);
                // console.log(total_carton);
            });
            // total_carton += parseInt(quantity);

            $('#total_carton').val(total_carton.toFixed(2));
        }



        function calculateCbm() {
            // $('.cbm').keyup(function() {
            var total_cbm = 0;
            $("#customFields tr.txtMult").each(function() {
                // console.log('ZZZ');
                var row = $(this).closest('tr');
                var cbm = row.find('.cbm').val();
                total_cbm += parseFloat(cbm);
                // console.log(days);
                // });
            });
            // console.log(total_cbm);
            // total_cbm += parseInt(quantity);

            $('#total_cbm').val(total_cbm.toFixed(2));
        }

        $('.cbm').keyup(function() {
            console.log('zaky');
            calculateCbm();
        });

        function calculateNetWeight() {
            var total_net_weight = 0;
            $("#customFields tr.txtMult").each(function() {
                var row = $(this).closest('tr');
                var net_weight = row.find('.net_weight').val();
                total_net_weight += parseInt(net_weight);
                // console.log(days);
                // console.log(total_net_weight);
            });
            // total_net_weight += parseInt(quantity);

            $('#total_net_weight').val(total_net_weight.toFixed(2));
        }

        function calculateGrossWeight() {
            var total_gross_weight = 0;
            $("#customFields tr.txtMult").each(function() {
                var row = $(this).closest('tr');
                var gross_weight = row.find('.gross_weight').val();
                total_gross_weight += parseInt(gross_weight);
                // console.log(days);
                // console.log(total_gross_weight);
            });
            // total_gross_weight += parseInt(quantity);

            $('#total_gross_weight').val(total_gross_weight.toFixed(2));
        }

        $(document).on('change', "#customer_id", function() {

            let _this = $(this);
            let customer_id = _this.val();
            var company_id = _this.find(':selected').attr("data-company");
            $("#company_id").val(company_id);
            $.ajax({
                type: "POST",
                url: "{{ route('packing_list.invoiceCreationByCustomerId') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    customer_id: customer_id,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status) {
                        $("#invoice_creation_id option").remove();

                        let data = response.data;
                        option = '';
                        option += '<option value="-1" selected>Select Invoice No</option>';
                        for (var val in data) {
                            option += '<option value="' + data[val].id + '">' + data[val].invoice_no +
                                '</option>';
                        }
                        $('#invoice_creation_id').append(option);
                        $('#customFields').html('');
                        perfoma_invoice_id_check = new Array();
                    }
                }
            });

        });

        $(document).on('change', "#invoice_creation_id", function() {

            let _this = $(this);
            var perfoma_invoice = _this.val();

            // console.log('perfoma_invoice', perfoma_invoice);

            var invoice_text = _this.children("option").filter(":selected").text();

            $('#hidden_invoice_no').val(invoice_text);

            $("#customFields").html('');
            $('#awb_no').val();
            $('#awb_date').val();
            $('#form_no').val();
            $('#form_date').val();
            $('#shipped_per').val();
            $('#europe_shipment').val();
            $('#description').val();
            if (perfoma_invoice == -1) {
                _this.focus();
                alert('please select Perfoma Invoice');
            } else {

                $.ajax({
                    type: "POST",
                    url: "{{ route('getInvoiceCreationDetailsByInvoiceCreationId') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: perfoma_invoice,
                    },
                    success: function(response) {
                        // console.log('response',response);
                        if (response.status) {
                            let data = response.data;
                            let details = response.details;

                            // console.log('data',data);
                            // console.log('details',details);

                            $('#awb_no').val(data.awb_no);
                            $('#awb_date').val(data.awb_date);
                            $('#form_no').val(data.form_no);
                            $('#form_date').val(data.form_date);
                            $('#shipped_per').val(data.shipped_per);
                            $('#europe_shipment').val(data.europe_shipment);
                            // $('#customer_specific').val(data.customer_specific);
                            $('#description').val(data.description);

                            perfoma_invoice_id_check[perfoma_invoice_id_check.length] = perfoma_invoice;
                            // let data =  response.data;
                            // var temp = '';
                            var temp = response.table_row;

                            $("#customFields").append(temp);
                            calculateQuantity();
                            calculateCarton();
                            calculateCbm();
                            calculateNetWeight();
                            calculateGrossWeight();
                            //     $('#add_multi_rows_pi').val('-1').change();
                        }
                    }
                });
            }
        });
    </script>
@endsection
