<div class="modal-body">
    <form action="" method="POST" id="editBankDetailForm">
        <input type="hidden" name="id" value="{{$company->id}}">
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
                                                    <input name="branch_name" type="text" value="{{old('branch_name',$company->branch_name)}}"
                                                class="form-control" placeholder="Enter Branch Name">
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
                                                <input name="branch_address" type="text" value="{{old('branch_address',$company->branch_address)}}"
                                            class="form-control" placeholder="Enter Branch Address">
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
                                                <input name="branch_code" type="text" value="{{old('branch_code',$company->branch_code)}}"
                                            class="form-control" placeholder="Enter Branch Code">
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
                                                <input name="account_name" type="text" value="{{old('account_name',$company->account_name)}}"
                                            class="form-control" placeholder="Enter Account Name">
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
                                            <input name="account_number" type="text" value="{{old('account_number',$company->account_number)}}"
                                        class="form-control" placeholder="Enter Account Number">
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
                                        <input name="iban_number" type="text" value="{{old('iban_number',$company->iban_number)}}"
                                    class="form-control" placeholder="Enter Iban Number">
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
                                    <input name="swift_code" type="text" value="{{old('swift_code',$company->swift_code)}}"
                                class="form-control" placeholder="Enter Swift Code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" style="margin-top: 10px" class="btn btn-succes">Update</button>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>