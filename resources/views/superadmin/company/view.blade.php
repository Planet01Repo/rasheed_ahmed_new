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
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('company.add')}}">Add</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table company-respnsve-table" id="example3" >
                    <thead>
                      <tr>
                        <th style="min-width: 39px;">S.No</th>
                        <th style="min-width: 150px;">Name</th>
                        <th style="min-width: 150px;">Branch name</th>
                        <th style="min-width: 80px;">P.I. Prefix</th>  
                        <th style="min-width: 120px;">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @php ($count = 1)
                      @foreach( $data as $v)
                      <tr class="">
                        <td>{{ $count++ }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->branch_name }}</td>
                        <td>{{ $v->pi_prefix }}</td>
                        <td>
                          <a href="{{route('company.add')}}/{{$v['id']}}" class="btn-warning btn btn-sm" data-toggle="tooltip" title="Edit Company"><i class="fa fa-pencil"></i></a>
                          <a href="{{route('companydetails.index',$v['id'])}}" class="btn-danger btn btn-sm" data-toggle="tooltip" title="Add Bank Details"><i class="fa fa-university"></i></a>
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