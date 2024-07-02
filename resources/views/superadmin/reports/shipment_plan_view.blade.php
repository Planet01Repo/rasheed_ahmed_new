@extends('layouts.layout')

@section('content')
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>Dashboard</p>
                </li>
                <li>
                    <span>Reports</span>
                </li>
                <li>
                    <a href="#" class="active">Shipment Plan</a>
                </li>
            </ul>
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h3>Shipment Plan - <span class="semi-bold">Reports</span></h3>
            </div>
            <div class="grid-body no-border">
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <strong></strong> {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                @endif
                <form class="" action="{{ route('reports.shipment-plan-report') }}" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label my-label-style">Company*</label>
                            <select class="form-control select2" id="company" name="company">
                                <option value="" selected="" disabled="">-- Select Company --
                                </option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label my-label-style">Customer*</label>
                            <select class="form-control select2" id="customer_id" name="customer_id">
                                <option value="" selected="" disabled="">-- Select Customer --
                                </option>
                            </select>
                            @error('customer_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control select2" id="add_multi_rows_pi">
                                <option value="-1" selected>Select P.I No</option>
                            </select>
                            @error('perfoma_invoice_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            @error('perfoma_invoice_detail_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a id="btn_add_rows" class="btn btn-warning">Add P.I No</a>
                    </div>
                    <div class="col-md-6">
                        <label for="">Export Type</label>
                        <select name="export_type" id="">
                            <option value="pdf">PDF</option>
                            <option value="excel">EXCEL</option>
                        </select>
                        @error('export_type')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="responsive-scroll" style="width: 100%;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:60px;">Remove Row</th>
                                        <th class="text-center">Our Order</th>
                                        <th class="text-center">Article No</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Total Quantity</th>
                                        <th class="text-center">UOM</th>
                                        <th class="text-center">Article Rate</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Carton</th>
                                        <th class="text-center">Total</th>

                                    </tr>
                                </thead>
                                <tbody id="customFields1">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input type="submit" value="Generate" formtarget="_blank" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('includes.detail_modal')
    <div id="myModal" class="modal">
        <div class="modal-dialog modal-lg" role="document">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left">PI Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for=""><input type="checkbox" class="select_all" style="margin: 10px 5px"> Select
                                All</label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="background-change">
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Our Order</th>
                                            <th class="text-center">Article No</th>
                                            <th class="text-center">Size</th>
                                            <th class="text-center">Total Quantity</th>
                                            <th class="text-center">UOM</th>
                                            <th class="text-center">Cartons</th>
                                            <th class="text-center">Article Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customFields">

                                    </tbody>
                                </table>
                                <a href="javascript:void(0)" id="btn_add_rows_to_main_page" style="margin-top: 10px"
                                    class="btn btn-succes">Add</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).on('change', '#company', function() {
            route = '{{ route('ajax.get-customers-by-company', 'companyid') }}'
            dataId = $(this).val()
            route = route.replace('companyid', dataId)
            $.get(route, function(data, status) {
                $('#customer_id').html(`<option value="" selected="" disabled="">-- Select Customer --
                                </option>` + data);
                $('#customer_id').change();
            });
        })
        $(document).on('change', "#customer_id", function() {

            let _this = $(this);
            let customer_id = _this.val();
            var company_id = _this.find(':selected').attr("data-company");
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
                        $("#ship_to option").remove();

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
                        $('#customFields').html('');
                        perfoma_invoice_id_check = new Array();
                    }
                }
            });
        });
        var perfoma_invoiceIDs;
        var temp_array = new Array();
        var temp_array1 = new Array();
        var i = 0;
        var j = 0;
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
                            const customFields = document.getElementById("customFields");
                            // customFields.removeChild(customFields);
                            while (customFields.hasChildNodes()) {
                                customFields.removeChild(customFields.firstChild);
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
                    </tr>
                        `
                                // <input type="hidden" name="perfoma_invoice_detail_id[]" value="${data[val].id}" />
                                // <input type="hidden" class="perfoma_invoice_id" name="perfoma_invoice_id[]" value="${data[val].perfoma_invoice_id}" />
                                // <td class="text-center"> <input type="text" class="allow_decimal invoice_quantity" name="quantity[]" value="" /> </td>
                                // temp += '<td>' + data[val].id + '</td>';
                            }
                            $("#customFields").append(temp);
                            $('#add_multi_rows_pi').val('-1').change();
                        }

                        $('#myModal').modal('show');

                    }
                });

            }

        });

        $('.select_all').change(function() {
            if ($(this).prop('checked')) {
                $('.perfomaInvoiceCheckBox').prop('checked', true);
            } else {
                $('.perfomaInvoiceCheckBox').prop('checked', false);
            }
        });

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
                                if (!$(`#customFields1 .txtMult[data-rowid=${data[val]["id"]}]`)
                                    .length) {
                                    temp += `<tr class="txtMult" data-rowid="${data[val]["id"]}">
                                        <input type="hidden" name="perfoma_invoice_detail_id[]" value="${data[val].id}" />
                                        <input type="hidden" class="perfoma_invoice_id" name="perfoma_invoice_id[]" value="${data[val].perfoma_invoice_id}" />
                                    <td class="text-center"><a href="javascript:void(0);" class="remCF">Remove</a></td>
                                    <td class="text-center">${data[val].perfoma_invoice_no_local}</td>
                                    <td class="product_detail text-center" data-article-rate="${data[val].article_rate}" data-individual-packing="${data[val].product_individual_packing}">${data[val].product}</td>
                                    <td class="text-center">${data[val].size}</td>
                                    <td class="text-center remaining_quantity">${data[val].quantity}</td>
                                    <td class="text-center product_unit">${data[val].unit}</td>
                                    <td class="text-center">${data[val].article_rate}</td>
                                    <td class="text-center"> <input type="text" class="allow_decimal invoice_quantity" name="quantity[]" value="" /> </td>
                                    <td class="text-center carton"></td>
                                    <td class="text-center total"></td>
                                </tr>`
                                } else {
                                    alreadyExist = true
                                }
                            }
                            $("#customFields1").append(temp);

                        }
                    }

                });
            }

        });
        $("#customFields1").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
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
            }
        });

    </script>
@endsection
