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
                    Brand
                </li>
                {{-- <li><a href="#" class="active">{{ isset($data->id) ? 'Edit' : 'Add New' }}
                        {{ isset($title) ? $title : '' }}</a> </li> --}}
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="grid simple">
                        <div class="grid-title no-border">
                            <h4><span class="semi-bold">Brand Form</span></h4>
                        </div>
                        <div class="grid-body no-border">
                            <form class="ajaxForm validate" action="{{ route('brand.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
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
                                                        <input name="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            placeholder="Enter Name" value="{{ old('name', $data->name) }}">
                                                    </div>
                                                    @error('name')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="form-label">Is Active</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="input-with-icon right controls">
                                                        <i class=""></i>
                                                        <input type="checkbox" name="is_active" class="form-check-input"
                                                            id="is_active" value=""
                                                            {{ $data->is_active == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    @error('is_active')
                                                        <div class="invalid-feedback" style="color: red">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="clearfix"></div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br>
                                            {{-- <button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button> --}}
                                            <button class="btn btn-success btn-cons ajaxFormSubmitAlter"
                                                type="submit">Submit</button>

                                            <a href="{{ route('brand.index') }}" class="btn btn-default btn-cons">Back</a>
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
@endsection
