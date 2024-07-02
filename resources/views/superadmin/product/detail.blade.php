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
                  <a style="float: right;" class="btn btn-success btn-cons" href="{{route('product.view')}}">Back</a>
                  <div class="pull-right">
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table table-bordered table-striped">
                      <tr>
                        <td>Product Name</td>
                        <td>{{ $data->name }}</td>
                      </tr>
                      <tr>
                        <td>Customer</td>
                        <td>{{ (isset($data->customer['customer_company_name']) && $data->customer['customer_company_name'] != '')?  $data->customer['customer_company_name'] : 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Stitching Rate A</td>
                        <td>{{ $data->stitching_rate_a }}</td>
                      </tr>
                      <tr>
                        <td>Stitching Rate B</td>
                        <td>{{ $data->stitching_rate_b }}</td>
                      </tr>
                      <tr>
                        <td>Commission Rate</td>
                        <td>{{ $data->commission_rate }}</td>
                      </tr>
                      <tr>
                        <td>Elastic Comission Rate</td>
                        <td>{{ $data->elastic_commission_rate }}</td>
                      </tr>
                      <tr>
                        <td>Magzi Comission Rate</td>
                        <td>{{ $data->magzi_commission_rate }}</td>
                      </tr>
                      <tr>
                        <td>Article Rate</td>
                        <td>{{ $data->article_rate }}</td>
                      </tr>
                      <tr>
                        <td>Customer Article</td>
                        <td>{{ $data->customer_article }}</td>
                      </tr>
                      <tr>
                        <td>Brand Name</td>
                        <td>{{ $data->brand_name }}</td>
                      </tr>
                      <tr>
                        <td>Individual Packing</td>
                        <td>{{ $data->individual_packing }}</td>
                      </tr>
                      <tr>
                        <td>Bundle Packing</td>
                        <td>{{ $data->bundle_packing }}</td>
                      </tr>
                      <tr>
                        <td>Inner Carton</td>
                        <td>{{ $data->inner_carton }}</td>
                      </tr>
                      <tr>
                        <td>Inner Carton Dimension</td>
                        <td>
                          <?php
                            $cartonData = cartonData();
                            foreach( $cartonData as $k=>$v ){
                              ?>
                              <?= (@$data->inner_carton_dimension == $k)?$v:'';?> 
                              <?php
                            }
                          ?>
                          
                        </td>
                      </tr>
                      <tr>
                        <td>Outer Carton</td>
                        <td>{{ $data->master_carton }}</td>
                      </tr>
                      <tr>
                        <td>Outer Carton Dimension</td>
                        <td>
                          <?php
                            $cartonData = cartonData();
                            foreach( $cartonData as $k=>$v ){
                              ?>
                              <?= (@$data->master_carton_dimension == $k)?$v:'';?> 
                              <?php
                            }
                          ?>
                          
                        </td>
                      </tr>
                      
                      <tr>
                        <td>Net Weight Per Carton</td>
                        <td>{{ $data->net_weight_per_carton }}</td>
                      </tr>
                      
                      <tr>
                        <td>Gross Weight Per Carton</td>
                        <td>{{ $data->gross_weight_per_carton }}</td>
                      </tr>

                     
                      
                      <tr>
                        <td>Description</td>
                        <td><div>{!! $data->description !!}</div></td>
                      </tr>
                      <tr>
                        <td>Images</td>
                        <td>
                          @foreach($data->images as $v)
                          <img src="{{env('PRODUCT_IMAGES')}}{{ (file_exists(storage_path('product/').@$v->image) && @$v->image != '') ? @$v->image : 'dummy.jpeg' }}" width="100" /> 
                          @endforeach
                        </td>
                      </tr>
                      
                      <tr>
                        <td>Unit</td>
                        <td>
                          <?php
                            $measureData = measurementUnit();
                            foreach ($measureData as $k => $v) {
                              ?>
                              <?= (@$data->unit == $k)?$v:'';?> 
                              <?php
                            }
                          ?>
                          
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">Sizes:</td>
                      </tr>
                      
                      
                          @foreach($data->productsize as $v)
                            <tr>
                                <td colspan="2">
                                {{ $v->size['name']}}
                                </td>
                            </tr>
                          @endforeach
                        
                      
                  </table>
                  
                  <br>
                  
                  <div class="form-group">
                          <div class="row" >
                              <div class="col-md-12">
                                <div class="responsive-scroll" style="width: 100%;">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th class="text-center">S.No.</th>
                                        <th class="text-center">Material</th>
                                        <th class="text-center">Hand Rate</th>
                                        <th class="text-center">Press Rate</th>
                                        <th class="text-center">Consumption</th>
                                        <th class="text-center">Measurment</th>
                                        <th class="text-center">Usage</th>
                                      </tr>
                                    </thead>
                                    <tbody id="customFields">
                                         @php($i=1)
                                         @foreach(@$data->productmaterial as $v)
                                          <tr class="txtMult">
                                              <td class="text-center" style="width:60px;">{{$i++}}</td>
                                              <td>
                                                  {{$v->material['title']}}
                                              </td>
                                              
                                              <td>
                                                  {{@$v->material_hand_rate}}
                                              </td>
                                              <td>
                                                  {{@$v->material_press_rate}} 
                                              </td>
                                              <td>
                                                  {{@$v->consumption}} 
                                              </td>
                                              <td>
                                              <?php
                                              
                                                $measureData = measurementUnit();
                                                
                                                foreach ($measureData as $k2 => $v2) {
                                                    if ($k2 == @$v->measurement) {
                                                     echo $v2;
                                                    }
                                                } ?>
                                              </td>
                                              <td>
                                                  {{@$v->usaged}} 
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
<script>
function detail_template(data){
  var temp = "";
  temp += "<p><span style='font-weight:bold;'>Address  </span>"+data.address+" </p>"; 
  return temp; 
}
</script>
@endsection