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
        Product
      </li>
      <li><a href="#" class="active">{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}}</a> </li>
    </ul>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>{{isset($data->id) ? 'Edit' : 'Add New'}} {{(isset($title)) ? $title : ''}} <span class="semi-bold">Form</span></h4>
          </div>
          <div class="grid-body no-border">
            <form class="ajaxForm validate" action="{{route('product.post')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Article Name</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="pname" type="text" value="{{@$data->name}}" class="form-control" placeholder="Enter Article Name">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label my-label-style">Customer</label>

                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select class="form-control select2" id="customer_id" name="customer_id">
                            <option value="" selected="" disabled="">-- Select Customer --</option>
                            @foreach ($customer as $k => $v)
                            <option value="{{$v->id}}" {{($v->id == @$data->customer_id) ? 'selected' : '' }}>
                              {{ $v->customer_company_name }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Stitching Rate A</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="stitching_rate_a" type="text" value="{{@$data->stitching_rate_a}}" class="form-control allow_decimal" placeholder="Enter Stitching Rate A">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Stitching Rate B</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="stitching_rate_b" type="text" value="{{@$data->stitching_rate_b}}" class="form-control allow_decimal" placeholder="Enter Stitching Rate B">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label">Comission Rate</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="commission_rate" type="text" value="{{@$data->commission_rate}}" class="form-control allow_decimal" placeholder="Enter Comission Rate">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Elastic Comission Rate</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="elastic_commission_rate" type="text" value="{{@$data->elastic_commission_rate}}" class="form-control allow_decimal" placeholder="Enter Elastic Comission Rate">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Magzi Comission Rate</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="magzi_commission_rate" type="text" value="{{@$data->magzi_commission_rate}}" class="form-control allow_decimal" placeholder="Enter Magzi Comission Rate">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Customer Article</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="customer_article" type="text" value="{{@$data->customer_article}}" class="form-control" placeholder="Enter Customer Article">
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="clearfix"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Brand Name</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="brand_name" type="text" value="{{@$data->brand_name}}" class="form-control" placeholder="Enter Brand Name">
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}


                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Carton Packing</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="individual_packing" type="text" value="{{@$data->individual_packing}}" class="form-control txtboxToFilterCustom" placeholder="Enter Individual Packing">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Bundle Packing</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="bundle_packing" type="text" value="{{@$data->bundle_packing}}" class="form-control txtboxToFilterCustom" placeholder="Enter Bundle Packing">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="responsive-scroll" style="width: 100%;">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:60px;">Add/Remove Row</th>
                              <th class="text-center" style="min-width:200px;">Size</th>
                              <th class="text-center" style="min-width:200px;">Inner Carton Dimension</th>
                              <th class="text-center" style="min-width:200px;">Outer Carton Dimension</th>
                              <th class="text-center" style="min-width:200px;">Article Rate</th>
                              <th class="text-center" style="min-width:200px;">Net Weight Per Carton</th>
                              <th class="text-center" style="min-width:200px;">Gross Weight Per Carton</th>
                              <th class="text-center" style="min-width:200px;">CBM</th>
                              <!--<th class="text-center" style="min-width:200px;">Usage</th>-->
                            </tr>
                          </thead>
                          <tbody id="customFields1">
                            <tr class="txtMult">
                              <td class="text-center"><a href="javascript:void(0);" class="addSIZE">Add</a></td>
                              <td colspan="7"></td>
                            </tr>

                            @php($k = 1)
                            @if(!empty(@$data->id) && @$data->id != null)
                            @foreach(@$product_size as $v)
                            <tr class="txtMult">
                              <td class="text-center" style="width:60px;"><a href="javascript:void(1);" class="remSIZE">Remove</a></td>
                              <td>
                                <select style="width:100%" class="select2 size_id" id="sizes{{ $k++ }}" name="sizes[]">
                                  @foreach($sizes as $mt)
                                  <option {{($mt->id == $v->id) ? 'selected' : '' }} value="{{$mt->id}}">{{$mt->name}}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td>
                                <select name="inner_carton_dimension" class="select2 form-control">
                                  <option disabled selected>Select Inner Dimension</option>
                                  <?php
                                  $cartonData = cartonData();
                                  foreach ($cartonData as $k => $v) {
                                  ?>
                                    <option <?= (@$data->inner_carton_dimension == $k) ? 'selected' : ''; ?> value='<?= $k; ?>'><?= $v; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>                              
                              </td>
                              <td>
                                <select name="master_carton_dimension" class="select2 form-control">
                                  <option disabled selected>Select Outer Dimension</option>
                                  <?php
                                  $cartonData = cartonData();
                                  foreach ($cartonData as $k => $v) {
                                  ?>
                                    <option <?= (@$data->master_carton_dimension == $k) ? 'selected' : ''; ?> value='<?= $k; ?>'><?= $v; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>                              
                              </td>
                              <td>
                                <input type="text" class="article_rate" required style="width:100%" id="article_rate" name="article_rate" value="{{@$data->article_rate}}" placeholder="" />
                              </td>
                              <td>
                                <input name="net_weight_per_carton" type="text" value="{{@$data->net_weight_per_carton}}" class="form-control allow_decimal">
                              </td>
                              <!--<td>-->
                              <!--  <input type="text" class="usaged" required style="width:100%" id="usaged{{ $k++ }}" name="usaged[]" value="{{@$v->usaged}}" placeholder="" />-->
                              <!--</td>-->
                              <td>
                                <input name="gross_weight_per_carton" type="text" value="{{@$data->gross_weight_per_carton}}" class="form-control allow_decimal">
                              </td>
                              <td>
                                <input name="cbm" type="number" value="{{@$data->cbm}}" class="form-control allow_decimal">
                              </td>
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>


                <!--<div class="col-md-6">-->
                <!--  <div class="form-group">-->
                <!--    <div class="row ">-->
                <!--      <div class="col-sm-12 col-md-12">-->
                <!--        <label class="form-label"> Inner Packing</label>-->
                <!--      </div>-->
                <!--      <div class="col-sm-12 col-md-9">-->
                <!--        <div class="input-with-icon right controls">-->
                <!--          <i class=""></i>-->
                <!--          <input name="inner_carton" type="text" value="{{@$data->inner_carton}}" class="form-control txtboxToFilterCustom" placeholder="Enter Inner Packing">-->
                <!--        </div>-->

                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->

                
                
                 {{-- <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Inner Carton Dimension</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select name="inner_carton_dimension" class="select2 form-control">
                            <option disabled selected>Select Dimension</option>
                            <?php
                            // $cartonData = cartonData();
                            // foreach ($cartonData as $k => $v) {
                            // ?>
                            //   <option <?= (@$data->inner_carton_dimension == $k) ? 'selected' : ''; ?> value='<?= $k; ?>'><?= $v; ?></option>
                            // <?php
                            // }
                            // ?>
                          </select>
                        </div>

                      </div>
                    </div>
                  </div>
                </div> --}}
                <!--<div class="clearfix"></div>-->
                <!--<div class="col-md-6">-->
                <!--  <div class="form-group">-->
                <!--    <div class="row ">-->
                <!--      <div class="col-sm-12 col-md-12">-->
                <!--        <label class="form-label"> Outer Packing</label>-->
                <!--      </div>-->
                <!--      <div class="col-sm-12 col-md-9">-->
                <!--        <div class="input-with-icon right controls">-->
                <!--          <i class=""></i>-->
                <!--          <input name="master_carton" type="text" value="{{@$data->master_carton}}" class="form-control txtboxToFilterCustom" placeholder="Enter Outer Packing">-->
                <!--        </div>-->

                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                
                <div class="clearfix"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> HS Code</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="hs_code" type="text" value="{{@$data->hs_code}}" class="form-control" placeholder="Enter HS Code">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Unit</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select name="unit" class="unit select2 form-control">
                                      <option selected disabled>--- Select Measurement ---</option>
                                      <?php
                                      $measureData = measurementUnit();
                                      foreach ($measureData as $k2 => $v2) {
                                      ?>
                                        <option <?= ($k2 == @$data->unit) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                      <?php } ?>
                                </select>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                
                {{-- <div class="clearfix"></div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Sizes</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <select class="select2 form-control" name="sizes[]" multiple="multiple">
                          <?php
                            // foreach ($sizes as $k => $v) {
                            //     $selected = '';
                            //      if(!empty(@$data->id) && @$data->id != null)
                            //      {
                            //             foreach(@$product_size as $k2 => $v2)
                            //             {
                            //                 if($v2['size_id'] == $v['id'])
                            //                 {
                            //                     $selected = 'selected';                
                            //                 }
                            //             }         
                            //      }
                            
                            ?>
                          <option <?= $selected ?> value='<?= $v['id']; ?>'><?= $v['name']; ?></option>
                                  
                                  <?php
                            }
                            ?>
                        </select>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Article Rate</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="article_rate" type="text" value="{{@$data->article_rate}}" class="form-control allow_decimal" placeholder="Enter Article Rate">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Net Weight Per Carton</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="net_weight_per_carton" type="text" value="{{@$data->net_weight_per_carton}}" class="form-control allow_decimal" placeholder="Enter Net Weight Per Carton">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> Gross Weight Per Carton</label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="gross_weight_per_carton" type="text" value="{{@$data->gross_weight_per_carton}}" class="form-control allow_decimal" placeholder="Enter Gross Weight Per Carton">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>
                
                
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row ">
                      <div class="col-sm-12 col-md-12">
                        <label class="form-label"> CBM </label>
                      </div>
                      <div class="col-sm-12 col-md-9">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <input name="cbm" type="number" value="{{@$data->cbm}}" class="form-control allow_decimal" placeholder="Enter CBM Number">
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}

                <div class="clearfix"></div>
                {{-- <div class="col-md-12">
                  <div class="form-group">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label">Description</label>
                      </div>
                      <div class="col-md-12">
                        <div class="input-with-icon right controls">
                          <i class=""></i>
                          <textarea name="description" type="textarea" id="myeditor" class="editor form-control" placeholder="Enter Description">{!! @$data->description !!}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
                {{-- <div class="clearfix"></div>
                <div class="col-md-offset-3 col-md-6 ">
                  <div class="form-group">
                    @if(!empty(@$data->id) && @$data->id != null)
                    @php($appendedFiles = array())
                    @foreach($images as $img)
                    @php($file_path = env('PRODUCT_IMAGES').@$img['image'])
                    @if (!is_dir($file_path) && isset(get_headers($file_path)[0]) && @get_headers($file_path)[0] != "HTTP/1.0 404 Not Found")

                    <?php
                    // @$file_details = getimagesize(env('PRODUCT_IMAGES') . @$img->image);
                    // $size = File::size(storage_path('product/') . @$img->image);
                    // $appendedFiles[] = array(
                    //   "name" => @$img->image,
                    //   "type" => $file_details['mime'],
                    //   "size" => $size,
                    //   "file" => $file_path,
                    //   "data" => array(
                    //     "url" => $file_path,
                    //     "image_file_id" => $data->id
                    //   )
                    // );
                    ?>
                    @endif
                    @endforeach
                    @php($appendedFiles = json_encode($appendedFiles))
                    @endif
                    <input type="file" class="form-control" name="fileToUpload" id="fileUploader" multiple="" data-fileuploader-files='{!! @$appendedFiles !!}'>
                  </div>
                </div> --}}
                    
                <div class="clearfix"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="responsive-scroll" style="width: 100%;">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:60px;">Add/Remove Row</th>
                              <th class="text-center" style="min-width:200px;">Material</th>
                              <th class="text-center" style="min-width:200px;">Hand Rate</th>
                              <th class="text-center" style="min-width:200px;">Press Rate</th>
                              <th class="text-center" style="min-width:200px;">Consumption</th>
                              <th class="text-center" style="min-width:200px;">Measurment</th>
                              <!--<th class="text-center" style="min-width:200px;">Usage</th>-->
                            </tr>
                          </thead>
                          <tbody id="customFields">
                            <tr class="txtMult">
                              <td class="text-center"><a href="javascript:void(0);" class="addCF">Add</a></td>
                              <td colspan="6"></td>
                            </tr>

                            @php($k = 1)
                            @if(!empty(@$data->id) && @$data->id != null)
                            @foreach(@$product_material as $v)
                            <tr class="txtMult">
                              <td class="text-center" style="width:60px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>
                              <td>
                                <select style="width:100%" class="select2 material_id" id="material_id{{ $k++ }}" name="material_id[]">
                                  @foreach($material as $mt)
                                  <option "{{($mt->id == $v->id) ? 'selected' : '' }}" value="{{$mt->id}}">{{$mt->title}}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td>
                                <input type="text" class="only_num material_hand_rate" required style="width:100%" id="material_hand_rate{{ $k++ }}" name="material_hand_rate[]" value="{{@$v->material_hand_rate}}" placeholder="" />
                              </td>
                              <td>
                                <input type="text" class="only_num material_press_rate" required style="width:100%" id="material_press_rate{{ $k++ }}" name="material_press_rate[]" value="{{@$v->material_press_rate}}" placeholder="" />
                              </td>
                              <td>
                                <input type="text" class="consumption" required style="width:100%" id="consumption{{ $k++ }}" name="consumption[]" value="{{@$v->consumption}}" placeholder="" />
                              </td>
                              <td>
                                <select name="measurement[]" class="measurement">
                                  <option selected disabled>--- Select Measurement ---</option>
                                  <?php
                                  $measureData = measurementUnit();
                                  foreach ($measureData as $k2 => $v2) {
                                  ?>
                                    <option <?= ($k2 == @$v->measurement) ? 'selected' : ''; ?> value='<?= $k2 ?>'><?= $v2 ?></option>
                                  <?php } ?>
                                </select>
                              </td>
                              <!--<td>-->
                              <!--  <input type="text" class="usaged" required style="width:100%" id="usaged{{ $k++ }}" name="usaged[]" value="{{@$v->usaged}}" placeholder="" />-->
                              <!--</td>-->
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-12">
                  <div class="form-group text-center">
                    </br><button class="btn btn-success btn-cons ajaxFormSubmitAlter" type="button">Submit</button>
                    <a class="btn btn-default btn-cons" href="{{route('product.view')}}" >Back</a>
                    <input name="id" type="hidden" value="{{ @$data->id }}">
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
<script>
  $(document).ready(function() {
      
    
    $("form.validate").validate({
      rules: {
        "sizes[]": {
          required: true,
        },

        hs_code: {
          required: true,
        }
        /* pname:{
           required: true
         },
         stitching_rate_a:{
           required: true,
           digits: true
         },
         stitching_rate_b:{
           required: true,
           digits: true
         },
         commission_rate:{
           required: true,
           digits: true
         },
         elastic_commission_rate:{
           required: true,
           digits: true
         },
         magzi_commission_rate:{
           required: true,
           digits: true
         },*/
      },
      messages: {},
      invalidHandler: function(event, validator) {
        //display error alert on form submit 
        error("Please input all the mandatory values marked as red");

      },
      errorPlacement: function(label, element) { // render error placement for each input type   
        var icon = $(element).parent('.input-with-icon').children('i');
        icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
        $('<span class="error"></span>').insertAfter(element).append(label);
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');
      },
      highlight: function(element) { // hightlight error inputs
        var icon = $(element).parent('.input-with-icon').children('i');
        icon.removeClass('fa fa-check').addClass('fa fa-exclamation');
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control');
      },
      unhighlight: function(element) { // revert the change done by hightlight
        var icon = $(element).parent('.input-with-icon').children('i');
        icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
        var parent = $(element).parent();
        parent.removeClass('error-control').addClass('success-control');
      },
      success: function(label, element) {
        var icon = $(element).parent('.input-with-icon').children('i');
        icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control');

      }

    });
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#fileUploader').fileuploader({
    changeInput: '<div class="fileuploader-input">' +
      '<div class="fileuploader-input-inner">' +
      '<img src="{{ asset("assets/admin/myplugin/fileuploader/images/fileuploader-dragdrop-icon.png") }}">' +
      '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
      '<p>or</p>' +
      '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
      '</div>' +
      '</div>',
    theme: 'dragdrop',
    limit: 2,
    addMore: true,
    extensions: ['jpg', 'jpeg', 'png'],
    onRemove: function(item) {
      $.post('{{route("product.image.delete")}}', {
        file: item.name,
        data: {
          image_file_id: "{{ @$data->id }}",
          file: item.name,
          image_post_file_id: item.data.image_file_id,
          "_token": $('meta[name="csrf-token"]').attr('content')
        }
      });
    },
    captions: {
      feedback: 'Drag and drop files here',
      feedback2: 'Drag and drop files here',
      drop: 'Drag and drop files here'
    },
  });
  var max_fields = 6;
  var add_button = $("#customFields .addCF");
  var x = 1;
  var material = '{!! json_encode($material) !!}';
  material = JSON.parse(material);
  $(add_button).click(function(e) {
    e.preventDefault();
    $('form.validate').validate();
    x++;
    var temp = '<tr class="txtMult">';
    temp += '<td class="text-center" style="width:60px;"><a href="javascript:void(0);" class="remCF">Remove</a></td>';
    temp += "<td>";
    temp += '<select class="material_id" name="material_id[]" id="material' + x + '" >';
    temp += '<option value="">';
    temp += '-- Select Material --';
    temp += '</option>';
    for (var n = 0; n < material.length; n++) {
      temp += '<option value="' + material[n].id + '" data-hand-price="' + material[n].hand_cutting_rate + '" data-press-price="' + material[n].press_cutting_rate + '">';
      temp += material[n].title;
      temp += '</option>';
    }
    temp += '</select>';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text" readonly class=" only_num material_hand_rate" required  style="width:100%" id="material_hand_rate' + x + '" data-optional="0" name="material_hand_rate[]" value="" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text" readonly class="only_num material_press_rate" required  style="width:100%" id="material_press_rate' + x + '" data-optional="0" name="material_press_rate[]" value="" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text"  class="consumption" required  style="width:100%" id="consumption' + x + '" data-optional="0" name="consumption[]" value="" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<select name="measurement[]" class="measurement" id="measurement' + x + '" >';
    temp += '<option selected disabled>--- Select Measurement ---</option>';
    <?php
    $measureData = measurementUnit();
    foreach ($measureData as $k2 => $v2) {
    ?>
      temp += '<option value="<?= $k2 ?> "><?= $v2 ?></option>';
    <?php } ?>
    temp += '</select>';
    temp += '</td>';
    // temp += "<td>";
    // temp += '<input type="text"  class="usaged" required  style="width:100%" id="usaged' + x + '" data-optional="0" name="usaged[]" value="" placeholder="" />';
    // temp += '</td>';
    temp += '</tr>';

    $("#customFields").append(temp);
    $("#material" + x).select2();
    $("#measurement" + x).select2();
  });
  $("#customFields").on('click', '.remCF', function() {
    $(this).parent().parent().remove();
  });


  var max_fields = 7;
  var add_size_button = $("#customFields1 .addSIZE");
  var x = 1;
  var sizes = '{!! json_encode($sizes) !!}';
  sizes = JSON.parse(sizes);
  $(add_size_button).click(function(e) {
    e.preventDefault();
    $('form.validate').validate();
    x++;
    var temp = '<tr class="txtMult">';
    temp += '<td class="text-center" style="width:60px;"><a href="javascript:void(0);" class="remSIZE">Remove</a></td>';
    temp += "<td>";
    temp += '<select class="sizes" name="sizes[]" id="sizes' + x + '" >';
    temp += '<option value="">';
    temp += '-- Select Size --';
    temp += '</option>';
    for (var n = 0; n < sizes.length; n++) {
      temp += '<option value="' + sizes[n].id + '">';
      temp += sizes[n].name;
      temp += '</option>';
    }
    temp += '</select>';
    temp += '</td>';
    temp += "<td>";
    temp += '<select name="inner_carton_dimension" class="inner_carton_dimension" id="inner_carton_dimension' + x + '" >';
    temp += '<option selected disabled>--- Select Inner Dimension ---</option>';
    <?php
    $cartonData = cartonData();
    foreach ($cartonData as $k => $v) {
    ?>
      temp += '<option value="<?= $k ?> "><?= $v ?></option>';
    <?php } ?>
    temp += '</select>';
    temp += '</td>';
    temp += "<td>";
    temp += '<select name="master_carton_dimension" class="master_carton_dimension" id="master_carton_dimension' + x + '" >';
    temp += '<option selected disabled>--- Select Outer Dimension ---</option>';
    <?php
    $cartonData = cartonData();
    foreach ($cartonData as $k => $v) {
    ?>
      temp += '<option value="<?= $k ?> "><?= $v ?></option>';
    <?php } ?>
    temp += '</select>';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text"  class="article_rate" required  style="width:100%" id="article_rate' + x + '" data-optional="0" name="article_rate" value="{{ @$data->article_rate }}" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text"  class="form-control allow_decimal" required  style="width:100%" id="net_weight_per_carton' + x + '" data-optional="0" name="net_weight_per_carton" value="{{ @$data->net_weight_per_carton }}" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="text"  class="form-control allow_decimal" required  style="width:100%" id="gross_weight_per_carton' + x + '" data-optional="0" name="gross_weight_per_carton" value="{{ @$data->gross_weight_per_carton }}" placeholder="" />';
    temp += '</td>';
    temp += "<td>";
    temp += '<input type="number" required  style="width:90%"  class="form-control allow_decimal" id="cbm' + x + '" data-optional="0" name="cbm" value="{{ @$data->cbm }}" placeholder="" />';
    temp += '</td>';
    // temp += "<td>";
    // temp += '<input type="text"  class="usaged" required  style="width:100%" id="usaged' + x + '" data-optional="0" name="usaged[]" value="" placeholder="" />';
    // temp += '</td>';
    temp += '</tr>';

    $("#customFields1").append(temp);
    $("#sizes" + x).select2();
    $("#measurement" + x).select2();
  });
  $("#customFields1").on('click', '.remSIZE', function() {
    $(this).parent().parent().remove();
  });
  $(document).on('keypress', ".only_num", function(e) {
    var x = e.which || e.keycode;
    if ((x >= 48 && x <= 57)) {
      return true;
    } else {
      e.preventDefault();
      return false;
    }
  });

  $(document).on('change', ".material_id", function() {
    var row = $(this).closest('tr');
    var material_id = $(this).val();
    var hand_price = $('option:selected', this).attr("data-hand-price");
    var press_price = $('option:selected', this).attr("data-press-price");
    row.find('.material_hand_rate').val(hand_price);
    row.find('.material_press_rate').val(press_price);

  });
</script>
@endsection