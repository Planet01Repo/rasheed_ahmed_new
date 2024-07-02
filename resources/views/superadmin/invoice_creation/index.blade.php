@extends('layouts.layout')

<style>
  .pdf-button{
    margin-top: 5px;
  }
</style>

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
        <h3>View All --- <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="clearfix"></div>
            <br>
            
            <div class="grid-title">
              <h4>View All <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h4>
              <a style="float: right; margin-top: -4px;" class="btn btn-success btn-cons" href="{{route('invoice_creation.create')}}">Create Invoice</a>
              <div class="pull-right">
              </div>
            </div>
            <div class="grid-body ">
              @if (Session::has('error'))
              <div class="alert alert-danger">
                  <strong>Danger!</strong> {{Session::get('error')}}
              </div>
              @endif
              @if (Session::has('success'))
              <div class="alert alert-success">
                  <strong>Success!</strong> {{Session::get('success')}}
              </div>
              @endif
              <table class="table" id="invoice_data_table" >
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Invoice Date</th>
                    <th>Invoice No</th>
                    <th>Customer Company Name</th>
                    <th>Description</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                @php ($count = 1)
                  @foreach( $data as $v)
                  <tr class="">
                    <td>{{ $count++ }}</td>
                    <td>{{ @$v->invoice_creation_date }}</td>
                    <td>{{ @$v->invoice_no }}</td>
                    <td>{{ @$v->customer->customer_company_name }}</td>
                    <td>{!! $v->description !!}</td>
                    <td>
                      <a href="{{route('invoice_creation.edit',$v['id'])}}" class="d-inline btn-warning btn btn-sm " data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                      <a href="{{route('invoice_creation.excel', $v->id )}}" target="_blank" class="d-inline btn-danger btn btn-sm pdf-button "  title="View Excel" ><i class="fa fa-file-excel-o"></i></a>
                        <a href="{{route('invoice_creation.pdf', $v->id )}}" target="_blank" class="d-inline btn-primary btn btn-sm pdf-button "  title="View Pdf" ><i class="fa fa-print"></i></a>
                        <a href="{{route('invoice_creation.delete', $v->id)}}" rel="delete" class="ajax btn-danger btn btn-sm delete-button"><i class="fa fa-times"></i></a>
                      {{-- <a href="{{route('perfoma_invoice.detail', $v->id )}}" class="d-inline btn-primary btn btn-sm "  title="View Detail" ><i class="fa fa-eye"></i></a>
                      <a href="{{route('perfoma_invoice.add')}}/{{$v['id']}}" class="d-inline btn-warning btn btn-sm " data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> --}}
                      
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

  $(document).ready(function () {
    $('#invoice_data_table').dataTable();
    // $('#invoice_data_table').dataTable({
    //     "order": [],
    // } );
  });

</script>
@endsection