<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    body {
      font-family: 'Calibri',sans-serif;
    }

    @page {
      margin: 10px 2% 10px 0;
    }

    body {
      margin: 10px;
    }

    .table1 {
      font-size: 12px;
    }

    .table2 {
      font-size: 10px;
    }

    .table_align {
      margin-left: 0%;
      margin-right: 0%;
    }

    .table1-td-h4 {
      color: #333333;
    }

    .table1-td-h4-2 {
      color: #7f7f7f;
    }

    .table1-td-quotHeading {
      text-align: right;
      font-size: 24px;
      /*font-weight: bold;*/
    }

    .product-table1-txt-align {
      position: relative;
      right: 0;
    }

    .product-table2-th-details {
      /*border: 1px solid #adadad; */
      background-color: #3c3d3a;
      color: #fff;
    }

    .product-table2-td-details {
      border: 1px solid #adadad;
    }

    .div-controls {
      margin-left: 8.5%;
      margin-right: 8.5%;
    }

    .div-font-controls {
      font-family: Calibri;
      font-size: 12px;
    }

    /*@page toc { sheet-size: A4; }
      span, strong, em, i, p{
        font-family: calibri;
      }*/
    .td-border {
      border: 7px double #000;
    }

    .pagebreak {
      page-break-before: always;
    }
    *
    {
      font-family: 'Calibri',sans-serif;
    }
    .Table {
      width:100%;
      display: table;
      font-size:12px;
    }

    .Title {
      display: table-caption;
      text-align: center;
      font-weight: bold;
      font-size: larger;
    }

    .Heading {
      display: table-row;
      font-weight: bold;
      text-align: center;
    }

    .Row {
      display: table-row;
    }

    .Cell {
      display: table-cell;
      border:1px solid;
      padding-left: 5px;
      padding-right: 5px;
    }
    .Cell-body {
      display: table-cell;
      border-left:1px solid;
      border-right:1px solid;
      padding-left: 5px;
      padding-right: 5px;
    }
  </style>
</head>

<body>

  <br />
  <table width="100%" class="table1 table_align" style="border-collapse: collapse;border:1px solid #000;" >
    <thead>
        <tr>
            <td colspan="4" align="center" width="100%" height="40px" bgcolor="grey">
                <h3>PURCHASE ORDER</h3>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="100%" height="40px" >&nbsp;</td>
        </tr>
        <tr>
            <td width="60px" style="padding:0 3px;"><b>To:</b></td>
            <td width="242px" ><b><?= $data->supplier['company_name'];?></b></td>
            <td width="60px">&nbsp;</td>
            <td width ="100px"><b>Date : <span> <?= date("d-m-Y", strtotime(@$data->date));?> </span></b></td>
        </tr>
        
        <tr>
            <td width="60px"></td>
            <td width="242px" ><?= $data->supplier['company_address'];?></td>
            <td width="60px">&nbsp;</td>
            <td width ="100px"><b>PO#: <span><?= $data->po_no ?></span></b></td>
        </tr>
        
        <tr>
            <td width="60px" ></td>
            <td width="242px" ><b>Attn:</b><?= $data->supplier['name'];?></td>
            <td width="60px">&nbsp;</td>
            <td width ="100px"></td>
        </tr>
        
        <tr>
            <td width="60px" style="padding:0 3px;"></td>
            <td width="242px" ><b>Phone:</b> <?= $data->supplier['contact_no'];?></td>
            <td width="60px"></td>
            <td width ="100px">
                <b>Shipping Method:</b>
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
            <td width="60px">&nbsp;</td>
            <td width="242px" rowspan="1"><b>E-mail: </b><span><?= $data->supplier['email'];?></span></td>
            <td width="60px">&nbsp;</td>
            <td width="100px"><b>Price Base</b>
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
            <td width="60px">&nbsp;</td>
            <td width="242px" rowspan="1"><b>Payment Terms: </b><span>{!! $data->payment_terms !!}</span></td>
            <td width="60px">&nbsp;</td>
            <td width="100px">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" width="100%" height="40px" >&nbsp;</td>
        </tr>
        
    </thead>
  </table>
  <div class="Table border">
    
    <div class="Heading ">
      <div class="Cell grey" style="width:100px">
        <p>No.</p>
      </div>
      <div class="Cell grey" style="width:250px;text-align:center">
        <p>Details</p>
      </div>
      <div class="Cell grey">
        <p>Quantity</p>
      </div>
      <div class="Cell grey">
        <p>UOM</p>
      </div>
      <div class="Cell grey">
        <p>U/Price</p>
      </div>
      <div class="Cell grey">
        <p>
            Amount
            <?php
             $currency = currency();
             foreach ($currency as $k2 => $v2) {
             ?>
                <?= ($k2 == $data->customer['currency']) ? $v2 : ''; ?> 
            <?php } ?>
        </p>
      </div>
    </div>
    
    @php ($count = 0)
    @php ($i = 1)
    @php ($total = 0)
    @foreach( $data->purchase_order_detail as $v)
    <div class="Row" >
      <div class="Cell-body">
        <p class="text-center">{{ $i++ }}</p>
      </div>
      <div class="Cell-body">
        <p >{{ $v->po_material['name'] }}</p>
      </div>
      <div class="Cell-body text-right">
        <p >{{ $v->quantity }}</p>
      </div>
      <div class="Cell-body">
        <p class="text-center"><?php
        $measureData = measurementUnit();
        foreach ($measureData as $k2 => $v2) {
        ?>
            <?php if($k2 == @$v->unit){
              echo $v2;
            } ?>
        <?php } ?>
        </p>
      </div>
      <div class="Cell-body text-right">
        <p >{{ number_format($v->rate,3) }}</p>
      </div>
      <div class="Cell-body text-right">
        <p>
            {{ number_format($v->rate*$v->quantity,2) }}
        </p>
      </div>
      @php ( $total += @$v->rate*@$v->quantity )
    </div>
    @php ($count ++)
    @endforeach
     <?php
    $row= 11-$count-1;
      for ($i= 0; $i<11 - $count;$i++) {
          if($row == $i)
          {
           ?>
           <div class="Row" >
              <div class="Cell-body">
                <p>&nbsp;</p>
              </div>
              <div class="Cell-body">
                
              </div>
              <div class="Cell-body">
                
              </div>
              <div class="Cell-body">
                <p></p>
              </div>
              <div class="Cell-body">
                <p></p>
              </div>
              <div class="Cell-body">
                <p></p>
              </div>
            </div>
           <?php
          }else
          {
           
          ?>
            <div class="Row" >
      <div class="Cell-body">
        <p>&nbsp;</p>
      </div>
      <div class="Cell-body">
        <p></p>
      </div>
      <div class="Cell-body">
        <p></p>
      </div>
      <div class="Cell-body">
        <p></p>
      </div>
      <div class="Cell-body">
        <p></p>
      </div>
      <div class="Cell-body">
        <p></p>
      </div>
    </div>
    <?php
          }
      }
    ?>
     <!-- Footer Row -->
    <div class="Row" >
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell">
        <p  style="text-align:right;font-weight:600;"></p>
      </div>
      
      <div class="Cell">
        <p style="text-align:right;font-weight:600;">Total </p>
      </div>
      <div class="Cell text-right">
        <p style="text-align:right;font-weight:600;"><?= number_format($total,2); ?></p>
      </div>
    </div>
    
    
   
    
  </div>

  <div style="position:absolute;">
      <p><b>Remarks/Instructions:</b></p>
   {!! $data->notes !!}
  </div>

  <style type="text/css">
    .ol-list{
        padding:0 20px;
    }
    .border {
      border:1px solid;
    }

    .border-bottom {
      border-bottom:1px solid;
    }

    .text-center {
      text-align: center;
    }
    .text-right {
      text-align: right;
    }
    .grey
    {
      background-color: grey;
    }
  </style>


</body>

</html>