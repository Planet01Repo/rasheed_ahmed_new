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
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('supplier.add')}}">Add</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table customer-respnsve-table" id="example3" >
                    <thead>
                      <tr>
                        <th style="min-width:30px;">S.No</th>
                        <th style="min-width:100px;">Name</th>
                        <th style="min-width:100px;">Company Name</th>
                        <th style="min-width:100px;">Currency</th>
                        <th style="min-width:100px;">Email</th>
                        <th style="min-width:100px;">Phone</th>
                        <th style="min-width:120px;">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @php ($count = 1)
                      @foreach( $data as $v)
                      <tr class="">
                        <td align="center">{{ $count++ }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->company_name }}</td>
                        <td>
                            <?php
                              $currency = currency();
                              foreach ($currency as $k2 => $v2) {
                              ?>
                                 <?= ($k2 == @$v->currency) ? $v2 : ''; ?> 
                              <?php } ?>
                            
                        </td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->contact_no }}</td>
                        <td>
                          <a href="#" class="btn-primary btn btn-sm detailModalBtn" data-toggle="tooltip" title="View Detail" data-id="{{ $v->id }}" data-path="{{route('supplier.detail', $v->id )}}"><i class="fa fa-eye"></i></a>
                          <a href="{{route('supplier.add')}}/{{$v['id']}}" class="btn-warning btn btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
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
  @include('includes.detail_modal')
@endsection
@section('footer')
<script>
function detail_template(data){
  var temp = "";
  temp += "<p><span style='font-weight:bold;'>Name  </span>"+data.name+" </p>";
  temp += "<p><span style='font-weight:bold;'>Company Name  </span>"+data.company_name+" </p>";
  temp += "<p><span style='font-weight:bold;'>Email  </span>"+data.email+" </p>";
  temp += "<p><span style='font-weight:bold;'>Phone  </span>"+data.contact_no+" </p>";
  temp += "<p><span style='font-weight:bold;'>Company Address  </span>"+data.company_address+" </p>"
  return temp; 
}
</script>
@endsection