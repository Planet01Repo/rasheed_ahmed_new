@extends('layouts.layout')

@section('content')
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">
         <ul class="breadcrumb">
        <li>
          <p>Dashboard</p>
        </li>
        <li><a href="#" class="active">View <?= (isset($title))?$title:''; ?></a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>View - <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h3>
      </div>
     
        <!-- <div class="row-fluid"> -->
           <!-- <div class="col-md-offset-3 col-md-6"> -->
             <!-- <h2>Chnage Password</h2> -->
            <div class="row">
              <div class="col-md-12">
                <div class="grid simple">
                  <div class="grid-title no-border"> 
                    <h4>{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}} <span class="semi-bold">Form</span></h4>
                  </div>
                <div class="grid-body no-border">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
             <form class="" method="POST" action="{{ route('change.password') }}">
                @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 col-md-12"> 
                        <label class="form-label">Current Password</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">                                       
                          <i class=""></i>
                          <input id="current-password" type="password" class="form-control" name="current-password" required>
                          @if ($errors->has('current-password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('current-password') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 col-md-12"> 
                        <label class="form-label">New Password</label>
                      </div>
                      <span class="help"></span>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">                                       
                          <i class=""></i>
                          <input id="new-password" type="password" class="form-control" name="new-password" required>
                          @if ($errors->has('new-password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('new-password') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
                <div class="clearfix"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 col-md-12"> 
                        <label class="form-label">Confirm New Password</label>
                      </div>
                      <span class="help"></span>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">                                       
                          <i class=""></i>
                          <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>
              
                <div class="col-md-12">
                  <div class="form-group text-center">
                    </br><button type="submit" class="btn btn-success btn-cons">Change Password</button>
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
@endsection