@extends('layouts.layout')

<style>
  /* @media screen and (max-width: 1261px) and (min-width: 1090px) {
  .delete-button {
    position: relative !important;
    top: 5px !important;
   width: 38px;
  } */
  /* @media screen and (max-width: 1267px) and (min-width: 1090px) {
  .edit-button {
   margin-top: 4px;
   width: 38px;
  } */
  /* @media screen and (max-width: 1275px) and (min-width: 1268px) {
    .delete-button {
      margin-top: 4px;
    }
    .edit-button {
      margin-top: 4px;
    }
  } */
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
        <h3>View All - <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h3>
      </div>
     
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="clearfix"></div>
                <br>
                
                <div class="grid-title">
                  <h4>View All <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h4>
                  <a style="float: right; margin-top: -4px;" class="btn btn-success btn-cons" href="{{route('product.add')}}">Add</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table" id="example3" >
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Article Name</th>
                        <th>Stitching Rate A</th>
                        <th>Stitching Rate B</th>
                        <th>Commission Rate</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @php ($count = 1)
                      @foreach( $data as $v)
                      <tr class="">
                        <td>{{ $count++ }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->stitching_rate_a }}</td>
                        <td>{{ $v->stitching_rate_b }}</td>
                        <td>{{ $v->commission_rate }}</td>
                        <td><img width="50" src="{{env('PRODUCT_IMAGES')}}{{ (file_exists(storage_path('product/').@$v->images[0]->image) && @$v->images[0]->image != '') ? @$v->images[0]->image : 'dummy.jpeg' }}" /></td>
                        <td><img width="50" src="{{env('PRODUCT_IMAGES')}}{{ (file_exists(storage_path('product/').@$v->images[1]->image) && @$v->images[1]->image != '') ? @$v->images[1]->image : 'dummy.jpeg'  }}"/></td>
                        <td>
                          <a href="{{route('product.detail', $v->id )}}" class="btn-primary btn btn-sm" style="margin-top: 3px"  title="View Detail" ><i class="fa fa-eye"></i></a>
                          <a href="{{route('product.add')}}/{{$v['id']}}" class="btn-warning btn btn-sm edit-button" style="margin-top: 3px" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="{{route('product.delete', $v['id'])}}" rel="delete" style="margin-top: 3px" class="ajax btn-danger btn btn-sm delete-button"><i class="fa fa-times"></i></a>
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