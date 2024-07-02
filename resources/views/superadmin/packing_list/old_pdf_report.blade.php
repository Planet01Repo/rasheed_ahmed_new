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
    .b-black{
      padding: 10px;
    }
    .b-black-for-goods{
      padding: 0px 10px 10px 10px;
    }
    .tg  {border-collapse:collapse;border-spacing:0; border: 1px solid #000;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:3px 10px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:3px 10px;word-break:normal;}
.tg .tg-tdlr{background-color:#ffffff;border-color:#ffffff;font-size:12px;text-align:left;vertical-align:top}
.tg .tg-wmqn{background-color:#ffffff;border-color:#ffffff;font-size:12px;text-align:left;vertical-align:top}
.tg-new {
        border-collapse: collapse;
        border-spacing: 0;
    }
    
    .tg-new td {
        border-style: solid;
        border-width: 0px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }
    
    .tg-new th {
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }
    
    .tg-new .tg-new-zv4m {
        text-align: left;
        vertical-align: top
    }
    
    .tg-new .tg-new-0pky {
        border-color: inherit;
        text-align: left;
        vertical-align: top;
        padding: 5px 0px 3px 10px
    }
    
    table.tg-new {
        width: 100%;
    }
    
    table.tg-new tr td {
        border-left: 1px solid #000 !important;
        border-right: 1px solid #000 !important;
    }
    
    table.tg-new tfoot tr td {
        border-top: 1px solid #000 !important;
        border-bottom: 1px solid #000 !important;
    }
    
    table.tg-new tr th {
        border: 1px solid #000;
    }
    table{
      font-size: 12px !important;
    }

    .font-10{
      font-size: 10px !important;
    }
  </style>
</head>

<body>
    <header></header>
    <footer></footer>
  <div class="border" style="border-bottom:none">
    <div class="border-bottom text-center grey" >
      PACKING LIST
    </div>
    

    <table class="tg" width="100%">
      <thead>
        <tr>
          <th class="tg-tdlr"><span style="font-weight:bold">Invoice No:</span> {{@$data->invoice_no}}</th>
          <th class="tg-tdlr"><span style="font-weight:bold">Date: </span><span style="font-weight:normal">
            @php
              $total_quantity = 0;
              $date = date_create(now());
              echo date_format($date,"jS M, Y");
            @endphp
          </span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">Shipped Per:</span> {{@$data->shipped_per}}</td>
          @foreach ($detail_data as $item)
          @php
              if (@$item->product->unit == '7') 
              {
                 $total_quantity = $total_quantity + ($item->quantity / 2);
                //  echo (int)$item->quantity / 2;
              }
              elseif (@$item->product->unit == '8') 
              {
                 $total_quantity = $total_quantity + ($item->quantity * 12);
                //  echo (int)$item->quantity * 12;
              }
              else{
                $total_quantity = $total_quantity + $item->quantity;
              }
          @endphp
        @endforeach
          <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity: {{@number_format($total_quantity)}} PRS</span></td>
          {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity: {{@$data->quantity}} PRS</span></td> --}}
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">BL / AWB No: </span>{{@$data->awb_no}} 
            <span class="font-10" style="font-weight:bold">Date: 
            @php
              $date = date_create(@$data->awb_date);
              echo date_format($date,"jS M, Y");
            @endphp
            </span>
          </td>
          <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{@number_format($detail_data->sum('carton'))}} CTN</span></td>
          {{-- <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{@$total_carton}} CTN</span></td> --}}
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">F.I No:</span> {{@$data->form_no}} 
            <span class="font-10" style="font-weight:bold">Date: 
            @php
              $date = date_create(@$data->form_date);
              echo date_format($date,"jS M, Y");
            @endphp
            </span>
          </td>
          {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: 0 CBM</span></td> --}}
          {{-- <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{@$total_volume}} CBM</span></td> --}}
          <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{@number_format($detail_data->sum('cbm'),2)}} CBM</span></td>
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">Price Base:</span> {{@$data->customer->price_base}}</td>
          <td class="tg-tdlr"><span style="font-weight:bold">Payment terms: </span><span style="font-weight:normal">{{@$data->customer->payment_terms}}</span></td>
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">Bill To: </span><span style="font-weight:normal">{{@$data->customer->bill_to}}</span></td>
          <td class="tg-tdlr"><span style="font-weight:bold">Ship to: </span><span style="font-weight:normal">{{@$data->customer->address}}</span></td>
        </tr>
        <tr>
          {{-- <td class="tg-wmqn" colspan="2"><span style="font-weight:bold">Description of goods: </span><span style="font-weight:normal">Demo Description here. Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here Demo Description here</span></td> --}}
          <td class="tg-wmqn" colspan="2"><span class="a" style="font-weight:bold">Description of goods: </span><span class="a" style="font-weight:normal">{{ @$data->description }}</span></td>
        </tr>
      </tbody>
      </table>



      <table class="tg-new">
        <thead>
            <tr>
                <th class="tg-new-0pky"><span style="font-weight:bold">PO #</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">ARTICLE #</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">SIZE </span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">QTY</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">UOM</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">PACK</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold; padding-right:6px">CTN</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">CBM</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">NW/KG.</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">GW/KG</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">CTN SERIAL</span></th>
            </tr>
        </thead>
        <tbody>
          @php
              $amount = 0.0;
              $total_amount = 0.0;
              $total_quantity = 0;
              $total_ctn = 0;
              $total_cbm = 0;
              $total_net_weight = 0;
              $total_gross_weight = 0;
              $carton_count = 0;
          @endphp
          @foreach ($detail_data as $key => $item)
          @php
              $amount = @sprintf("%.3f",@$item->quantity) * @sprintf("%.3f",@$item->perfomaInvoiceDetail->product->article_rate);
              $total_amount += $amount;
          @endphp
          <tr class="description_rows">
            <td class="tg-new-0pky">{{@$data->invoiceCreation->invoiceCreationDetail[$key]->perfomaInvoice->po_number}}</td>
            {{-- <td class="tg-new-0pky"></td> --}}
            <td class="tg-new-0pky">{{@$item->product->name}}</td>
            <td class="tg-new-0pky">{{@$item->size->name}}</td>
            <td class="tg-new-0pky">
              @php
              
              if (@$item->product->unit == '7') 
              {
                 $total_quantity = $total_quantity + ($item->quantity / 2);
                //  echo (int)$item->quantity / 2;
              }
              elseif (@$item->product->unit == '8') 
              {
                 $total_quantity = $total_quantity + ($item->quantity * 12);
                //  echo (int)$item->quantity * 12;
              }
              else{
                $total_quantity = $total_quantity + $item->quantity;
              }
              @endphp   


              {{@number_format($item->quantity)}}</td>
            <td class="tg-new-0pky">{{@measurementUnit()[@$item->product->unit]}}</td>
            <td class="tg-new-0pky">{{@number_format($item->product->individual_packing) }}</td>
            <td class="tg-new-0pky">{{@$item->carton}}</td>
            <td class="tg-new-0pky">{{@number_format($item->cbm,2)}}</td>
            <td class="tg-new-0pky">{{@number_format($item->net_weight,2)}}</td>
            <td class="tg-new-0pky">{{@number_format($item->gross_weight,2)}}</td>
            <td class="tg-new-0pky">{{ sprintf("%03d",($carton_count + 1))." - ". sprintf("%03d",($carton_count + $item->carton)) }}</td>
            @php
                $carton_count += $item->carton;
            @endphp
        </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <th class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($total_quantity)}}</span></th>
                <td class="tg-new-0pky">PRS</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($detail_data->sum('carton'))}}</span></td>
                <th class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($detail_data->sum('cbm'),2)}}</span></th>
                <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($detail_data->sum('net_weight'),2)}}</span></td>
                <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($detail_data->sum('gross_weight'),2)}}</span></td>
                
                <td class="tg-new-0pky"><span style="font-weight:bold">{{@number_format($detail_data->sum('carton'))}}</span></td>
            </tr>
          </tfoot>
        
    </table>

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