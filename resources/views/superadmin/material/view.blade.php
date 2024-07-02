@extends('layouts.layout')

@section('content')
  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>Dashboard</p>
        </li>
        <li><a href="#" class="active">View All <?= (isset($title))?$title:''; ?></a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>View All - <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h3>
      </div>
     
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="clearfix"></div>
                <br>
                
                <div class="grid-title">
                  <h4>View All <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h4>
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('material.add')}}">Add</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table" id="example3" >
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Hand Cutting Rate</th>
                        <th>Press Press Rate</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @php ($count = 1)
                      @foreach( $data as $v)
                      <tr class="">
                        <td>{{ $count++ }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->hand_cutting_rate }}</td>
                        <td>{{ $v->press_cutting_rate }}</td>
                        <td>
                          <a href="{{route('material.add')}}/{{$v['id']}}" class="btn-warning btn btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                          <!--<a href="<?php // echo site_url($delete_product.'/'.@$v['user_id'])?>" rel="delete" class="ajax btn-danger btn btn-sm"><i class="fa fa-times"></i></a> -->
                        </td>
                       </tr>
                       @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
       
    </div>
    
  </div>
@endsection
@section('footer')

@endsection