<!doctype html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <title>Invoice</title>
    <style type="text/css">
     @page 
   { 
       margin-top: 250px !impotant; 
       margin-bottom: 180px !impotant;
   }
    header { position: fixed; left: 0px; top: -300px; right: 0px; height: 300px; background-color: orange; text-align: center; }
    footer { position: fixed; left: 0px; bottom: -220px; right: 0px; height: 220px; background-color: lightblue; }
  body *{
    margin-bottom: 0;
    }
    body
    {
      font-family: 'Calibri',sans-serif;
    }
    .Table {
      width:100%;
      display: table;
      font-size:10px;
      padding-top:0px;
      padding-bottom:0px;
      margin-top:0px;
      margin-bottom:0px;
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
      padding-top:0px;
      padding-bottom:0px;
      margin-top:0px;
      margin-bottom:0px;
    }

    .Cell {
      display: table-cell;
      border:1px solid;
      padding-left: 5px;
      padding-right: 5px;
      padding-top:0px;
      padding-bottom:0px;
      margin-top:0px;
      margin-bottom:0px;
    }
    .Cell-body {
      display: table-cell;
      border-left:1px solid;
      border-right:1px solid;
      padding-left: 5px;
      padding-right: 5px;
      padding-top:0px;
      padding-bottom:0px;
      margin-top:0px;
      margin-bottom:0px;
      height: 15px;
    }
    
  </style>
</head>

<body>
    <header></header>
    <footer></footer>
  <div class="border" style="height:150px;border-bottom:none">
    <div class="border-bottom text-center grey" >
      PROFORMA INVOICE
    </div>
    <div style="position:absolute;left:10px;top:10px;">
      <p style="font-size:12px"><strong style="font-size:14px">No:</strong> <?= @$data->perfoma_invoice_no_local?></p>
    </div>
    <div style="position:absolute;left:550px;top:15px;">
      <p style="font-size:12px"><strong style="font-size:14px">Date:</strong> <?= date("d-m-Y", strtotime(@$data->created_at));?></p>
    </div>
    
    <div style="position:absolute;left:10px;top:40px;">
      <p style="font-size:12px"> <strong style="font-size:14px">Shipped Per S.S:</strong> </p>
      
    </div>
    
    <div style="position:absolute;left:10px;top:60px;">
        <p>
           <strong style="font-size:14px">For Account of Messer:</strong>
        </p>
    </div>
    <div style="position:absolute;left:10px;top:78px;">
        <p style="font-size:12px">
         <?= @$data->customer['customer_company_name'] ?>
        </p>
    </div>
    
    
    <div style="position:absolute;left:10px;top:95px;">
      <p style="font-size:12px">
           <?= @$data->customer['address'] ?>
      </p>
    </div>
  
    <div style="position:absolute;left:150px;top:40px;">
      <p style="font-size:12px">
         <?php
            $shipData = shippping_method();
            foreach ($shipData as $k2 => $v2) {
            ?>
               <?php if($k2 == @$data->shipping_method){
                 echo $v2;
               } ?>
          <?php } ?>
      </p>
    </div>
    <div style="position:absolute;top:40px;left:550px;">
      <p style="font-size:12px"><strong style="font-size:14px">To:</strong> <?= @$data->to; ?></p>
    </div>

    <div style="position:absolute;top:115px;left:10px;">
      <p style="font-size:12px"><strong style="font-size:14px">Contact Person:</strong> <?= @$data->customer['name']; ?></p>
    </div>

  </div>
  <div class="border" style="padding-left:10px;border-top:none;margin-top:-12px">
    <p style="font-size:12px"><strong style="font-size:14px">Description:</strong> <?= @$data->description; ?></p>
  </div>
  <div class="Table border">
    
    <div class="Heading ">
      <div class="Cell grey" style="width:50px">
        <p>Marks & Nos.</p>
      </div>
      <!-- <div class="Cell grey" style="width:250px;text-align:left">
        <p>Product Description</p>
      </div> -->
      <div class="Cell grey">
        <p>Art No</p>
      </div>
      <div class="Cell grey">
        <p>Size</p>
      </div>
      <div class="Cell grey">
        <p>QTY</p>
      </div>
      <div class="Cell grey">
        <p>UOM</p>
      </div>
      <div class="Cell grey">
        <p>Pack</p>
      </div>
      <div class="Cell grey">
        <p>CTN</p>
      </div>
      <div class="Cell grey">
        <p>U.Price</p>
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
      @php ($t_qty = 0)
      @php ($t_pack = 0)
      @php ($t_ctn = 0)
      @php ($t_amount = 0)
      @php ($s_no = 1)
      @php ($previous = '')
      @foreach( $detail_data as $v)
    <div class="Row" <?= ($previous == $v->product['id'])?'style="line-height:0.1px;"':''?>>
      <div class="Cell-body text-center">
        <p class="text-center">
            <?php if($count == 0){ ?>
            {{ @$data->marks_no_1 }} <br>
            {{ @$data->marks_no_2 }}
            {{ @$data->marks_no_3 }}
          <?php }else{
          ?>
            <p></p>
          <?php
          } ?>
        
        </p>
      </div>
      <!-- <div class="Cell-body " >
          <?php if($previous == $v->product['id']){ ?>
            <p></p>
          <?php }else{
          ?>
            <p style="font-size:9px">{{ $v->product['description'] }} </p>
          <?php
          } ?>
      </div> -->
      <div class="Cell-body ">
        <p>{{ $v->product['name'] }} </p>
      </div>
      <div class="Cell-body text-center">
        <p>{{ $v->size['name'] }}</p>
      </div>
      <div class="Cell-body text-right">
        <p>
          <?php
                echo $v->quantity;     
          ?>
        </p>
      </div>
      <div class="Cell-body text-center">
        <p>
            <?php
              $measurementUnit = measurementUnit();
              foreach ($measurementUnit as $k2 => $v2) {
              ?>
                 <?= ($k2 == @$v->unit) ? $v2 : ''; ?> 
              <?php } ?>
            
        </p>
      </div>
      <div class="Cell-body text-right">
        <p>{{ round($v->product['individual_packing'], 0) }} </p>
      </div>
      <div class="Cell-body text-right">
        <p>{{ $v->carton }}</p>
      </div>
      <div class="Cell-body text-right">
        <p>{{ $v->article_rate }}</p>
      </div>
      <div class="Cell-body text-right">
        <p>
            {{ number_format($v->article_rate*$v->quantity,2) }}
           
        </p>
      </div>
    </div>
      @php($previous = $v->product['id'])
      @php ($count ++)
      @php ($s_no ++)
      @php ($t_pack += $v->product['individual_packing'] )
      @php ($t_ctn += $v->carton)
      @php ($t_amount += $v->article_rate*$v->quantity)
      <?php
        if(@$v->unit == 8)
        {
            $t_qty += $v->quantity*12;     
        }
        else if(@$v->unit == 7)
        {
            $t_qty += $v->quantity/2;     
        }
        else 
        {
            $t_qty += $v->quantity;     
        }
      ?>
    @endforeach
         <div class="Row" style="line-height:0.1px">
              <div class="Cell-body">
                <p>&nbsp;</p>
              </div>
              <div class="Cell-body">
                <p><strong>For Basis</strong></p>
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
              <div class="Cell-body">
                <p></p>
              </div>
              <div class="Cell-body">
                <p></p>
              </div>
            </div>
            <div class="Row" style="line-height:7px">
              <div class="Cell-body">
                <p>&nbsp;</p>
              </div>
              <div class="Cell-body">
                <p><strong>Payment Terms:</strong> <?= $data->payment_terms?></p>
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
              <div class="Cell-body">
                <p></p>
              </div>
              <div class="Cell-body">
                <p></p>
              </div>
            </div>
   
    <!-- Footer Row -->
    <div class="Row" >
      <div colspan="2" class="Cell">
        <p>Total:</p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell text-right">
        <p><?= $t_qty;?></p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell text-right">
        <p><?= $t_ctn;?></p>
      </div>
      <div class="Cell">
        <p></p>
      </div>
      <div class="Cell text-right">
        <p>
            <?= number_format($t_amount,2); ?>
           
        </p>
      </div>
    </div>
    
    
  </div>
  <?= @$data->europe_shipment; ?>
  <div style="">
    <p ><b style="font-size:12px">Bank Details as follow:</b></p>
    <p ><b style="font-size:12px">ASKARI BANK LIMITED</b></p>
    <p style="line-height:0.2px;font-size:12px">Korangi Industrial Area, Karachi, Pakistan</p>
    <p style="line-height:0.2px;font-size:12px">Branch Code: 0060 (Swift ID: ASCMPKKA)</p>
    <p style="line-height:0.2px;font-size:12px">Title A/C : Fine Grip Import Export A/C NO: 00600380803931</p>
    <p style="line-height:0.2px;font-size:12px">IBAN No: PK91ASCM0000600380803931</p>
  </div>
  <?= @$data->customer_specific; ?>
    
  <style type="text/css">
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