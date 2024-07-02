@extends('layouts.layout')

@section('content')
    <!-- BEGIN PAGE CONTAINER-->
    <style>
        .select2-container {
            width: 100% !important;
        }

        .modal-backdrop.in {
            position: relative !important;
        }

        span.close {
            position: relative;
            top: -2px !important;
        }

        .responsive-scroll {
            background: white;
            padding: 20px !important;
        }

        .background-change th {
            background: #6f7b8a;
            color: white;
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

        #customField tr td {
            background: #fbf7e7 !important;
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

        #btn_add_rows_to_main_page {
            background: #6f7b8a;
            color: white;
            font-weight: 600;
            margin-top: 10px !important;
            margin-right: 12px !important;
            padding-top: 5px !important;
        }

        .text-center {
            background-color: #fefefe;
        }

        .error-focus {
            border: 1px solid red !important;
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
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <strong>Danger!</strong> {{ Session::get('error') }}
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <strong>Success!</strong> {{ Session::get('success') }}
                                </div>
                            @endif
                            <form class="" action="{{ route('invoice_creation.update', @$data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label my-label-style">Customer*</label>
                                            <select class="form-control select2 @error('customer_id') error-focus @enderror"
                                                id="customer_id" name="customer_id">
                                                <option value="" selected="" disabled="">-- Select Customer --
                                                </option>
                                                @foreach ($customer as $k => $v)
                                                    <option value="{{ $v->id }}" data-company="{{ $v->company->id }}"
                                                        data-prefix="{{ $v->company->prefix }}"
                                                        data-invoice_prefix="{{ $v->company->invoice_prefix }}"
                                                        {{ $v->id == @$data->customer_id ? 'selected' : '' }}>
                                                        {{ $v->customer_company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input id="company_id" name="company_id" type="hidden" value="">
                                        </div>
                                    </div>
                                    {{-- @dd($data->customer_id) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label my-label-style">Bank Details*</label>
                                            <select class="form-control select2" id="company_detail_id"
                                                name="company_detail_id">
                                                {{-- <option value="{{$data->companyDetails->id}}" {{old('company_detail_id',$data->companyDetails->id) == $data->companyDetails->id?'selected':'' }}>{{$data->companyDetails->branch_name}}/{{$data->companyDetails->account_number}}</option> --}}
                                                @foreach ($data->customer->company->companyDetails as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('company_detail_id', $item->id) == $data->company_detail_id ? 'selected' : '' }}>
                                                        {{ $item->branch_name }}/{{ $item->account_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">BL / AWB No</label>
                                            <input name="awb_no" type="text" value="{{ @$data->awb_no }}"
                                                class="form-control @error('awb_no') error-focus @enderror"
                                                placeholder="Enter BL / AWB No">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">BL / AWB Date</label>
                                            @php
                                                $awb_date = date_create(@$data->awb_date);
                                            @endphp
                                            <input name="awb_date" type="date"
                                                value="{{ date_format($awb_date, 'Y-m-d') }}"
                                                class="form-control @error('awb_date') error-focus @enderror datepicker"
                                                placeholder="Enter BL / AWB Date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">F.I No</label>
                                            <input name="form_no" type="text" value="{{ @$data->form_no }}"
                                                class="form-control @error('form_no') error-focus @enderror"
                                                placeholder="Enter F.I Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">F.I Date</label>
                                            @php
                                                $form_date = date_create(@$data->form_date);
                                            @endphp
                                            <input name="form_date" type="date"
                                                value="{{ date_format($form_date, 'Y-m-d') }}"
                                                class="form-control @error('form_date') error-focus @enderror datepicker"
                                                placeholder="Enter Form E Date">
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Amount In Words*</label>
                                            <div class="input-group">
                                                <div class="input-group-addon" id="amountInWords"></div>
                                                <input name="amount_in_words" style="position: initial" type="text"
                                                    value="{{ @$data->amount_in_words }}" class="form-control"
                                                    placeholder="Enter Amount In Words" id="amount_in_words">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Description of Goods*</label>
                                            <textarea name="description" id="" rows="5"
                                                class="form-control @error('description') error-focus @enderror">{{ @$data->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Customer Specific Details</label>
                                            <textarea name="customer_specific" type="textarea" rows="5"
                                                class="form-control @error('cutsomer_specific') error-focus @enderror"
                                                placeholder="Enter Customer Specific Details">{{ @$data->customer_specific }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Freight Rate</label>
                                            <input name="freight_rate" id="freight_rate" type="number"
                                                value="{{ @$data->freight_rate }}" class="form-control"
                                                placeholder="Enter Freight Rate">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Shipped Per*</label>
                                            <input name="shipped_per" type="text" value="{{ @$data->shipped_per }}"
                                                class="form-control @error('shipped_per') error-focus @enderror"
                                                placeholder="Enter Shipped Per">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    {{-- @dd($data->customer->address) --}}
                                    {{-- @dd($ab,$data->ship_to) --}}
                                    @php
                                        $ship_to = explode(',', $data->customer->address);
                                        $s_index = 0;
                                    @endphp

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label my-label-style">Ship To</label>
                                            <select class="form-control select2" id="ship_to" name="ship_to[]"
                                                multiple="multiple">
                                                {{-- <option value="" selected="" disabled="">-- Select Ship To Address --</option> --}}
                                                @foreach ($ab as $item)
                                                    <option value="{{ $item }}"
                                                        {{ old('ship_to[]', $item) == $ship_to[$s_index++] ? 'selected' : '' }}>
                                                        {{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label my-label-style">Payment Date</label>
                                            <input type="date" class="form-control" name="payment_date"
                                                value="{{ old('payment_date', $data->payment_date) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control select2" id="add_multi_rows_pi">
                                                <option value="-1" selected>Select P.I No</option>
                                                @if (isset($perfomaInvoice))
                                                    @foreach ($perfomaInvoice as $item)
                                                        <option value="{{ @$item->id }}">
                                                            {{ @$item->perfoma_invoice_no_local }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a id="btn_add_rows" class="btn btn-warning">Add P.I No</a>
                                    </div>
                                    <div id="myModal" class="modal">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-left">PI Detail</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for=""><input type="checkbox" class="select_all"
                                                                style="margin: 10px 5px"> Select
                                                            All</label>
                                                        {{-- <span style="margin-top: -6px;" class="close">&times;</span> --}}
                                                        {{-- <div class="row" style="padding-top: 5px !important"> --}}
                                                        {{-- <div class="col-md-12"> --}}
                                                        {{-- <div class="responsive-scroll" style="width: 100%;"> --}}
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr class="background-change">
                                                                        <th class="text-center">Action</th>
                                                                        <th class="text-center">Our Order</th>
                                                                        {{-- <th class="text-center">Customer PO</th> --}}
                                                                        {{-- <th class="text-center">H.S Code</th> --}}
                                                                        <th class="text-center">Article No</th>
                                                                        <th class="text-center">Size</th>
                                                                        <th class="text-center">Remaining Quantity</th>
                                                                        <th class="text-center">UOM</th>
                                                                        <th class="text-center">Carton</th>
                                                                        <th class="text-center">Article Rate</th>
                                                                        <th class="text-center">Freight Rate</th>

                                                                        {{-- <th class="text-center">Quantity</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                {{-- <tr class="txtMult">
                                                                                        <td class="text-center"><a href="javascript:void(0);" class="addCF">Add</a></td>
                                                                                        <td colspan="9"></td>
                                                                                    </tr> --}}
                                                                <tbody id="customField">

                                                                </tbody>
                                                            </table>
                                                            <a id="btn_add_rows_to_main_page"
                                                                class="btn btn-succes">Add</a>
                                                        </div>
                                                        {{-- </div> --}}
                                                        {{-- </div> --}}
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal content -->

                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" style="padding-top: 5px !important">
                                        <div class="col-md-12">
                                            <div class="responsive-scroll" style="width: 100%;">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Action</th>
                                                            <th class="text-center">Our Order</th>
                                                            <th class="text-center">Article No</th>
                                                            <th class="text-center">Freight Rate</th>
                                                            <th class="text-center">Size</th>
                                                            <th class="text-center">Total Quantity</th>
                                                            {{-- <th class="text-center">Remaining Quantity</th> --}}
                                                            <th class="text-center">UOM</th>
                                                            <th class="text-center">Article Rate</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Carton</th>
                                                            <th class="text-center">Total</th>

                                                        </tr>
                                                    </thead>
                                                    {{-- @dd($detail_data[0]->perfomaInvoiceDetail->article_rate) --}}
                                                    <tbody id="customField2">

                                                        @foreach ($detail_data as $key => $item)
                                                            <tr class="txtMult">
                                                                {{-- @dd($item) --}}
                                                                <input type="hidden" name="invoice_creation_detail_id[]"
                                                                    value="{{ @$item->id }}" />
                                                                <input type="hidden" name="perfoma_invoice_detail_id[]"
                                                                    value="{{ @$item->perfoma_invoice_detail_id }}" />
                                                                {{-- <input type="hidden" class="perfoma_invoice_id" name="perfoma_invoice_id[]" value="{{@$item->perfoma_invoice_id}}"
                                                        /> --}}
                                                                {{-- <input type="hidden" name="perfoma_invoice_detail_id[]" value="{{@$item->id}}"
                                                        /> --}}
                                                                <input type="hidden" name="perfoma_invoice_id[]"
                                                                    value="{{ @$item->perfoma_invoice_id }}" />

                                                                <td class="text-center"><a href="javascript:void(1);"
                                                                        class="remCF">Remove</a></td>
                                                                <td class="text-center">
                                                                    {{ @$item->perfomaInvoice->perfoma_invoice_no_local }}
                                                                </td>
                                                                <td class="text-center product_detail"
                                                                    data-article-rate="{{ @$item->perfomaInvoiceDetail->article_rate }}"
                                                                    data-individual-packing="{{ @$item->perfomaInvoiceDetail->product->individual_packing }}">
                                                                    {{ @$item->perfomaInvoiceDetail->product->name }}</td>
                                                                    
                                                                <td class="text-center">
                                                                    <input type="hidden" name="perfoma_freight_rate" id="perfoma_freight_rate" value="{{$item->perfomaInvoice->freight_rate}}">
                                                                    {{ @$item->perfomaInvoice->freight_rate ?? 0 }} </td>
                                                                <td class="text-center">
                                                                    {{ @$item->perfomaInvoiceDetail->size->name }} </td>
                                                                <td class="text-center remaining_quantity">
                                                                    {{ @$item->perfomaInvoiceDetail->quantity }}</td>
                                                                {{-- <td class="text-center remaining_quantity">{{@$item->perfomaInvoiceDetail->quantity - @$item->quantity}}
                                                        </td> --}}
                                                                <td class="text-center product_unit ">
                                                                    {{ @measurementUnit()[@$item->perfomaInvoiceDetail->unit] }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ @$item->perfomaInvoiceDetail->article_rate }}</td>
                                                                <td class="text-center"> <input type="text"
                                                                        class="allow_decimal invoice_quantity @error('quantity.' . $key) error-focus @enderror"
                                                                        name="quantity[]"
                                                                        value="{{ @$item->quantity }}" /> </td>
                                                                {{-- <td class="text-center carton">{{@$item->perfomaInvoiceDetail->carton}}
                                                        </td> --}}
                                                                <td class="text-center carton">
                                                                    <?= @$item->perfomaInvoiceDetail->product->individual_packing > 0 ? @$item->quantity / @$item->perfomaInvoiceDetail->product->individual_packing : 0 ?>
                                                                </td>
                                                                <td class="text-center total">
                                                                    {{ @$item->quantity * @$item->perfomaInvoiceDetail->article_rate }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tbody id="custom">
                                        <tr class="txtMult">
                                            <th class="">Total Quantity</th>
                                            <th style="border-right: 1px solid rgb(192, 192, 192) !important;"
                                                id="total_quantity"></th>
                                            <th class="">Total Carton</th>
                                            <th style="border-right: 1px solid rgb(192, 192, 192) !important;"
                                                id="total_carton"></th>
                                            <th class="">Total Amount</th>
                                            <th id="total_quantity_carton"></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <br>
                                        {{-- <button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button> --}}
                                        <button class="btn btn-success btn-cons ajaxFormSubmitAlter"
                                            type="submit">Submit</button>

                                        <a href="{{ route('invoice_creation.index') }}"
                                            class="btn btn-default btn-cons">Back</a>
                                        {{-- <input name="id" type="hidden" value="{{ @$data->id }}"> --}}
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
            $.get("/getCustomerCurrency/{{ $data->customer_id }}", function(data) {
                $('#amountInWords').html(data.currency);
            });
            $.get("/editShipTo/{{ $data->customer_id }}", function(data) {
                $('#ship_to').html(data);
                $('#ship_to').change();
            });
        });

        var th_val = ['', 'thousand', 'million', 'billion', 'trillion'];
        // System for uncomment this line for Number of English 
        // var th_val = ['','thousand','million', 'milliard','billion'];

        var dg_val = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        var tn_val = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen',
            'nineteen'
        ];
        var tw_val = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

        function toWordsconver(s) {
            s = s.toString();
            s = s.replace(/[\, ]/g, '');
            if (s != parseFloat(s))
                return 'not a number ';
            var x_val = s.indexOf('.');
            if (x_val == -1)
                x_val = s.length;
            if (x_val > 15)
                return 'too big';
            var n_val = s.split('');
            var str_val = '';
            var sk_val = 0;
            for (var i = 0; i < x_val; i++) {
                if ((x_val - i) % 3 == 2) {
                    if (n_val[i] == '1') {
                        str_val += tn_val[Number(n_val[i + 1])] + ' ';
                        i++;
                        sk_val = 1;
                    } else if (n_val[i] != 0) {
                        str_val += tw_val[n_val[i] - 2] + ' ';
                        sk_val = 1;
                    }
                } else if (n_val[i] != 0) {
                    str_val += dg_val[n_val[i]] + ' ';
                    if ((x_val - i) % 3 == 0)
                        str_val += 'hundred ';
                    sk_val = 1;
                }
                if ((x_val - i) % 3 == 1) {
                    if (sk_val)
                        str_val += th_val[(x_val - i - 1) / 3] + ' ';
                    sk_val = 0;
                }
            }
            if (x_val != s.length) {
                var y_val = s.length;
                str_val += 'point ';
                for (var i = x_val + 1; i < y_val; i++)
                    str_val += dg_val[n_val[i]] + ' ';
            }
            return str_val.replace(/\s+/g, ' ');
        }

        function calculateQuantity() {
            let on_change_total_quantity = 0;
            $.each($('.invoice_quantity'), function(indexInArray, valueOfElement) {
                let _this = $(this);
                let val = _this.val();
                let unit = _this.closest('tr').find('.product_unit').text().trim();

                if (unit == 'DZN') {
                    if (val !== null || val !== undefined) {
                        on_change_total_quantity = on_change_total_quantity + (((val != '') ? parseInt(val) : 0) *
                            12);
                    }
                } else if (unit == 'PCS') {
                    if (val !== null || val !== undefined) {
                        on_change_total_quantity = on_change_total_quantity + (((val != '') ? parseInt(val) : 0) /
                            2);
                    }
                } else {
                    if (val !== null || val !== undefined) {
                        on_change_total_quantity = on_change_total_quantity + ((val != '') ? parseInt(val) : 0);
                    }
                }
            });
            $('#total_quantity').text(on_change_total_quantity.toFixed(2));
        }

        function calculateCartons() {
            let on_change_total_carton = 0;
            $.each($('.carton'), function(indexInArray, valueOfElement) {
                let _this = $(this);
                let val = _this.text().trim();
                if (val !== null || val !== undefined) {
                    on_change_total_carton = on_change_total_carton + ((val != '') ? parseFloat(val) : 0);
                }
            });
            $('#total_carton').text(on_change_total_carton.toFixed(2));
        }

        function calculateTotal() {
            let perfomaFreightRate = $('#perfoma_freight_rate').val();
            console.log(perfomaFreightRate);
            let freight_rate = $('#freight_rate').val();
            let on_change_total_quantity_carton = 0;
            let on_change_total_quantity_carton1 = 0;
            $.each($('.total'), function(indexInArray, valueOfElement) {
                let _this = $(this);
                let total = _this.text().trim().replace(',', '');
                if (total !== null || total !== undefined) {
                    if(freight_rate != 0)
                    {
                        on_change_total_quantity_carton = on_change_total_quantity_carton + ((total != '') ? parseFloat(
                            total) : 0);
                        on_change_total_quantity_carton1 = parseFloat(on_change_total_quantity_carton.toFixed(2)) +
                            parseInt(freight_rate);
                    }
                    else if(perfomaFreightRate != 0) 
                    {
                        on_change_total_quantity_carton = on_change_total_quantity_carton + ((total != '') ? parseFloat(
                            total) : 0);
                        on_change_total_quantity_carton1 = parseFloat(on_change_total_quantity_carton.toFixed(2)) +
                            parseInt(perfomaFreightRate);
                    }
                    else
                    {
                        on_change_total_quantity_carton = on_change_total_quantity_carton + ((total != '') ? parseFloat(
                            total) : 0);
                        on_change_total_quantity_carton1 = parseFloat(on_change_total_quantity_carton.toFixed(2));
                    }
                }
            });
            // $.post( '<?= route('inwords') ?>', { _token: '{{ csrf_token() }}',numVal: on_change_total_quantity_carton1.toFixed(2) })
            //     .done(function( data ) {
            //         document.getElementById("amount_in_words").value = data.toUpperCase();
            // });
            let data = toWordsconver(on_change_total_quantity_carton1);
            document.getElementById("amount_in_words").value = data.toUpperCase();
            $('#total_quantity_carton').text(on_change_total_quantity_carton1.toFixed(2));
        }

        $('#freight_rate').keyup(function (e) { 
            calculateTotal();
        });

        var perfoma_invoice_id_check = new Array();
        $(document).ready(function() {
            var perfoma_invoice;
            calculateQuantity();
            calculateCartons();
            calculateTotal();
        });

        $(document).on('change', "#customer_id", function() {

            let _this = $(this);
            let customer_id = _this.val();
            var company_id = _this.find(':selected').attr("data-company");
            $.get("/editBankDetails/" + customer_id, function(data) {
                $('#company_detail_id').html(data);
            });
            $.get("/editShipTo/" + customer_id, function(data) {
                $('#ship_to').html(data);
                $('#ship_to').change();
            });
            $.get("/getCustomerCurrency/" + customer_id, function(data) {
                $('#amountInWords').html(data.currency);
            });
            $("#company_id").val(company_id);
            $.ajax({
                type: "POST",
                url: "{{ route('getPerfomaInvoiceByCustomerId') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    customer_id: customer_id,
                },
                success: function(response) {
                    if (response.status) {
                        $("#add_multi_rows_pi option").remove();
                        // $("#ship_to option").remove();

                        let data = response.data;
                        let customer_address = response.customer_ship_address;
                        option = '';
                        option_address = '';
                        option += '<option value="-1" selected>Select P.I No</option>';
                        option_address +=
                            '<option value="" disabled="" selected>Select Ship To Address</option>';
                        for (var val in data) {
                            option += '<option value="' + data[val].id + '">' + data[val]
                                .perfoma_invoice_no_local + '</option>';
                        }

                        for (var val in customer_address) {
                            option_address += '<option value="' + customer_address[val] + '">' +
                                customer_address[val] + '</option>';
                        }
                        $('#add_multi_rows_pi').append(option);
                        $('#ship_to').append(option_address);
                        $('#ship_to').trigger('change');
                        $('#customField').html('');
                        perfoma_invoice_id_check = new Array();
                    }
                }
            });

        });

        function fetch_customer_perfoma_invoice() {
            // var perfoma_invoice_no = $('.perfoma_no').val();
            var prefix = $('#customer_id').find(':selected').attr("data-prefix");
            var invoice_prefix = $('#customer_id').find(':selected').attr("data-invoice_prefix");
            var company_id = $('#customer_id').find(':selected').attr("data-company");
            $("#company_id").val(company_id);
            var customer_id = $('#customer_id').find(':selected').val();
            $.ajax({
                url: '{{ route('perfoma_invoice.customer_product') }}',
                dataType: "json",
                type: "POST",
                data: {
                    customer_id: customer_id
                },
                cache: false,
                success: function(result) {

                    $("#customField").html('');
                    perfoma_invoice = result['data'];
                    // add_multi_rows_pi
                    // var temp = '';
                    // var x = 0;
                }
            });
        }

        var x = 0;
        //   var add_button = $(".addCF");
        $(".addCF").click(function(e) {
            var check = $('#customer_id').valid();
            if (!check) {
                return false;
            }

            x++;
            e.preventDefault();
            // $('form.validate').validate();
            var temp = '<tr class="txtMult">';
            temp += '<td class="text-center"><a href="javascript:void(1);" class="remCF" id="rem">Remove</a></td>';
            temp += '<td class="text-center"><input type="checkbox" /></td>';

            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '<td></td>';
            temp += '</tr>';

            $("#customField2").append(temp);
        });

        //   $("#customFields").on('click', '.remCF', function() {
        //     $(this).parent().parent().remove();
        //   });

        //   $('#btn_add_rows').click(function (e) {
        $(document).on('click', "#btn_add_rows", function() {

            var perfoma_invoice = $('#add_multi_rows_pi').val();

            if (perfoma_invoice == -1) {
                $('#add_multi_rows_pi').focus();
                alert('please select Perfoma Invoice');
            } else if (perfoma_invoice_id_check.indexOf(perfoma_invoice) !== -1) {
                alert('You already select this Perfoma Invoice');
            } else {

                $.ajax({
                    type: "POST",
                    url: "{{ route('getPerfomaInvoiceDetailsByPerfomaInvoice') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: perfoma_invoice,
                    },
                    success: function(response) {
                        if (response.status) {
                            // perfoma_invoice_id_check[perfoma_invoice_id_check.length] = perfoma_invoice;
                            const customField = document.getElementById("customField");
                            // customFields.removeChild(customFields);
                            while (customField.hasChildNodes()) {
                                customField.removeChild(customField.firstChild);
                            }
                            let data = response.data;
                            var temp = '';
                            for (var val in data) {
                                let _checked = false
                                if (temp_array1[`parentId-${perfoma_invoice}`] != undefined) {
                                    if (temp_array1[`parentId-${perfoma_invoice}`].indexOf(data[val]
                                            .id) !== -1) {
                                        _checked = true
                                    }
                                }
                                temp += `<tr class="txtMult">
                                    <td class="text-center">
                                        <input type="checkbox" name="performaInvoiceId[]" class="performaInvoiceId perfomaInvoiceCheckBox" value="${data[val].id}" ${_checked?'checked':''} />
                                    </td>
                                    <td class="text-center">${data[val].perfoma_invoice_no_local}</td>
                                    <td class="text-center">${data[val].product}</td>
                                    <td class="text-center">${data[val].size}</td>
                                    <td class="text-center remaining_quantity">${data[val].quantity}</td>
                                    <td class="text-center">${data[val].unit}</td>
                                    <td class="text-center">${data[val].carton}</td>
                                    <td class="text-center">${data[val].article_rate}</td>
                                    <td class="text-center">${data[val].freight_rate ?? 0}</td>
                                </tr>
                                    `
                                // temp += '<tr class="txtMult">';
                                //     temp += '<input type="hidden" name="perfoma_invoice_detail_id[]" value="' + data[val].id + '" />';
                                //     temp += '<input type="hidden" name="perfoma_invoice_id[]" value="' + data[val].perfoma_invoice_id + '" />';

                                //     temp += '<td class="text-center"><a href="javascript:void(0);" class="remCF">Remove</a></td>';
                                //     temp += '<td class="text-center">' + data[val].perfoma_invoice_no_local + '</td>';
                                //     temp += '<td class="text-center">' + data[val].product + '</td>';
                                //     temp += '<td class="text-center">' + data[val].size + '</td>';
                                //     temp += '<td class="text-center remaining_quantity">' + data[val].quantity + '</td>';
                                //     temp += '<td class="text-center">' + data[val].unit + '</td>';
                                //     temp += '<td class="text-center">' + data[val].carton + '</td>';
                                //     temp += '<td class="text-center">' + data[val].article_rate + '</td>';
                                //     temp += '<td class="text-center"> <input type="text" class="allow_decimal invoice_quantity" name="quantity[]" value="" /> </td>';
                                //     // temp += '<td>' + data[val].id + '</td>';
                                // temp += '</tr>';
                            }
                            $("#customField").append(temp);
                            $('#add_multi_rows_pi').val('-1').change();
                        }
                        $('#myModal').modal('show');
                    }
                });
            }
        });

        // Get the modal
        var modal = document.getElementById("myModal");

        // // Get the button that opens the modal
        // var btn = document.getElementById("btn_add_rows");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
        //   modal.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            $('#myModal').modal('hide');
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var perfoma_invoiceIDs;
        var temp_array = new Array();
        var temp_array1 = new Array();
        var i = 0;
        var j = 0;
        $(document).on('click', "#btn_add_rows_to_main_page", function() {
            let temp_id = $(this).closest('.responsive-scroll').find('.perfoma_invoice_id').val();
            let check_box = $("#myModal .perfomaInvoiceCheckBox:checkbox:checked");
            perfoma_invoiceIDs = check_box.map(function() {
                return parseInt($(this).val());
            }).get();
            temp_array1[`parentId-${temp_id}`] = perfoma_invoiceIDs
            if (!perfoma_invoiceIDs.length) {
                $('#add_multi_rows_pi').focus();
                alert('please select Perfoma Invoice');
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('getPerfomaInvoiceDetails') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: perfoma_invoiceIDs,
                    },
                    success: function(response) {
                        perfoma_invoice_id_check[perfoma_invoice_id_check.length] = perfoma_invoiceIDs;

                        $('#myModal').modal('hide');
                        if (response.status) {
                            let data = response.data;
                            var temp = '';
                            for (var val in data) {
                                if (!$(`#customField2 .txtMult[data-rowid=${data[val]["id"]}]`)
                                    .length) {
                                    temp += `<tr class="txtMult" data-rowid="${data[val]["id"]}">
                                    <input type="hidden" name="invoice_creation_detail_id[]" value="0" />
                                    <input type="hidden" name="perfoma_invoice_detail_id[]" value="${data[val].id}" />
                                    <input type="hidden" class="perfoma_invoice_id" name="perfoma_invoice_id[]" value="${data[val].perfoma_invoice_id}" />
                                    <input type="hidden" class="freight_rate" name="freight_rate[]" value="${data[val].freight_rate ?? 0}" />
                                    <td class="text-center"><a href="javascript:void(1);" class="remCF">Remove</a></td>
                                    <td class="text-center">${data[val].perfoma_invoice_no_local}</td>
                                    <td class="product_detail text-center" data-article-rate="${data[val].article_rate}" data-individual-packing="${data[val].product_individual_packing}">${data[val].product}</td>
                                    <td class="text-center">${data[val].freight_rate ?? 0}</td>
                                    <td class="text-center">${data[val].size}</td>
                                    <td class="text-center remaining_quantity">${data[val].quantity}</td>
                                    <td class="text-center product_unit">${data[val].unit}</td>
                                    <td class="text-center">${data[val].article_rate}</td>
                                    <td class="text-center"> <input type="text" class="allow_decimal invoice_quantity" name="quantity[]" value="" /> </td>
                                    
                                    <td class="text-center carton"></td>
                                    <td class="text-center total"></td>
                                </tr>`
                                    // <td class="text-center">${data[val].carton}</td>
                                } else {
                                    alreadyExist = true
                                }
                            }
                            $("#customField2").append(temp);

                        }
                    }

                });
            }

        });

        $("#customField2").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
            calculateQuantity();
            calculateCartons();
            calculateTotal();
        });

        $(document).on('change keyup blur', ".invoice_quantity", function(e) {
            let _this = $(this);
            let row = _this.closest('tr');
            let approve = _this.val();
            let total = row.find('.remaining_quantity').text().trim().replace(',', '');
            var master_carton = row.find('.product_detail').attr("data-individual-packing");
            var article_rate = row.find('.product_detail').attr("data-article-rate");

            total = parseInt(total);
            approve = parseInt(approve);

            if (total < approve) {
                e.preventDefault();
                _this.val(total);

            } else {

                var carton = approve / master_carton;
                var product_total = article_rate * approve;

                row.find('.carton').text(carton.toFixed(2));
                row.find('.total').text(product_total.toFixed(2));

                calculateQuantity();
                calculateCartons();
                calculateTotal();
            }

        });

        $('.select_all').change(function() {
            if ($(this).prop('checked')) {
                $('.perfomaInvoiceCheckBox').prop('checked', true);
            } else {
                $('.perfomaInvoiceCheckBox').prop('checked', false);
            }
        });
    </script>
@endsection
