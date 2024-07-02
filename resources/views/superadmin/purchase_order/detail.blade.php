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
     
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="clearfix"></div>
                <br>
                
                <div class="grid-title">
                  <h4>View <span class="semi-bold"><?= (isset($title))?$title:''; ?></span></h4>
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('purchase_order.view')}}">Back</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table table-bordered table-striped">
                      <tr>
                       <td>Purchase Order No</td>
                       <td>{{ $data->po_no }}</td>
                      </tr>
                      <tr>
                       <td>Purchase Order Date</td>
                       <td>{{ $data->date }}</td>
                      </tr>
                      <tr>
                        <td>Import No</td>
                        <td>{{ $data->import_no }}</td>
                      </tr>
                      <tr>
                        <td>Shipping Method</td>
                        <td>
                            <?php
                            $shipData = shippping_method();
                            foreach ($shipData as $k2 => $v2) {
                            ?>
                               <?php if($k2 == @$data->shipping_method){
                                 echo $v2;
                               } ?>
                            <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Price Base</td>
                        <td>
                            <?php
                            $priceData = price_base();
                            foreach ($priceData as $k2 => $v2) {
                            ?>
                               <?php if($k2 == @$data->price_base){
                                 echo $v2;
                               } ?>
                            <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td>{{ (isset($data->supplier['name']) && $data->supplier['name'] != '')?  $data->supplier['name'] : 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Payment Terms</td>
                        <td><div>{!! $data->payment_terms !!}</div></td>
                      </tr>
                      <tr>
                        <td>Remarks/Instructions</td>
                        <td><div>{!! $data->notes !!}</div></td>
                      </tr>
                      

                      
                  </table>
                  
                  <br>
                  
                  <div class="form-group">
                          <div class="row" >
                              <div class="col-md-12">
                                <div class="responsive-scroll" style="width: 100%;">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th class="text-center" style="min-width:60px;">S.No.</th>
                                        <th class="text-center" style="min-width:200px;">PO Material Name</th>
                                        <th class="text-center" style="min-width:100px;">Quantity</th>
                                        <th class="text-center" style="min-width:100px;">Unit</th>
                                        <th class="text-center" style="min-width:100px;">Rate</th>
                                        <th class="text-center" style="min-width:100px;">Total</th>
                                      </tr>
                                    </thead>
                                    <tbody id="customFields">
                                      
                                         @php($i=1)
                                         @foreach(@$data->purchase_order_detail as $v)

                                         
                                          <tr class="txtMult">
                                              <td class="text-center" style="width:60px;">{{$i++}}</td>
                                              <td>
                                                  {{$v->po_material['name']}}
                                              </td>
                                              
                                              <td>
                                                  {{@$v->quantity}} 
                                              </td>
                                              <td>
                                                <?php
                                                $measureData = measurementUnit();
                                                foreach ($measureData as $k2 => $v2) {
                                                ?>
                                                   <?php if($k2 == @$v->unit){
                                                     echo $v2;
                                                   } ?>
                                                <?php } ?>
                                              </td>
                                              <td>
                                                  {{@$v->rate}} 
                                              </td>
                                              
                                              <td>
                                                  {{number_format(@$v->rate * @$v->quantity,2)}} 
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
            </div>
          </div>
       
    </div>
    
  </div>
  @include('includes.detail_modal')
@endsection
@section('footer')

@endsection