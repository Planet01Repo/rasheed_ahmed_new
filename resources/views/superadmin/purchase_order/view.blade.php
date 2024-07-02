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
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('purchase_order.add')}}">Add</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table" id="example3" >
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <!--<th>Invoice No</th>-->
                        <th>PO NO</th>
                        <th>Supplier Name</th>
                        <th>Import No</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @php ($count = 1)
                      @foreach( $data as $v)
                      <tr class="">
                        <td>{{ $count++ }}</td>
                        <!--<td>{{ $v->perfoma_invoice_no }}</td>-->
                        <td>{{ $v->po_no }}</td>
                        <td>{{ $v->supplier['name'] }}</td>
                        <td>{!! $v->import_no !!}</td>
                        <td>
                          <a href="{{route('purchase_order.detail', $v->id )}}" class="btn-primary btn btn-sm" style="margin-top: 3px"  title="View Detail" ><i class="fa fa-eye"></i></a>
                          <a href="{{route('purchase_order.add')}}/{{$v['id']}}" class="btn-warning btn btn-sm" style="margin-top: 3px" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="{{route('purchase_order.pdf', $v->id )}}" target="_blank" class="btn-primary btn btn-sm " style="margin-top: 3px" title="View Pdf" ><i class="fa fa-print"></i></a>
                          <a href="{{route('purchase_order.delete', $v['id'])}}" rel="delete" style="margin-top: 3px" class="ajax btn-danger btn btn-sm"><i class="fa fa-times"></i></a>
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
  temp += "<p><span style='font-weight:bold;'>Address  </span>"+data.address+" </p>"; 
  return temp; 
}
</script>
@endsection