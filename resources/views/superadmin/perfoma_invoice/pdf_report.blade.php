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
    header { position: fixed; left: 0px; top: -300px; right: 0px; height: 300px;  text-align: center; }
    footer { position: fixed; left: 0px; bottom: -220px; right: 0px; height: 220px; }
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
        vertical-align: top
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
  </style>
</head>

<body>
    <header></header>
    <footer></footer>
  <div class="border" style="border-bottom:none">
    <div class="border-bottom text-center grey" >
      PROFORMA INVOICE
    </div>
    

    <table class="tg" width="100%">
      <thead>
        <tr>
          <th class="tg-tdlr"><span style="font-weight:bold">Invoice No:</span> {{@$data->perfoma_invoice_no}}</th>
          <th class="tg-tdlr"><span style="font-weight:bold">Date: </span><span style="font-weight:normal">
            @php
              $date = date_create(now());
              echo date_format($date,"jS M, Y");
            @endphp
          </span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">Shipped Per:</span> {{@$data->shipped_per}}</td>
          <td class="tg-tdlr"><span style="font-weight:bold">Total Quantity: {{@$detail_data->sum('quantity')}} PRS</span></td>
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">BL / AWB No: </span>{{@$data->awb_no}} <span style="font-weight:bold">(Date: 
          @php
            $date = date_create(@$data->awb_date);
            echo date_format($date,"jS M, Y");
          @endphp
          )</span></td>
          <td class="tg-tdlr"><span style="font-weight:bold">No. Of Packages: {{@$detail_data->sum('carton')}} CTN</span></td>
        </tr>
        <tr>
          <td class="tg-tdlr"><span style="font-weight:bold">Form "E" No:</span> {{@$data->form_e_no}} <span style="font-weight:bold">(Date: 
            @php
            $date = date_create(@$data->form_e_date);
            echo date_format($date,"jS M, Y");
          @endphp
            )</span></td>
          <td class="tg-tdlr"><span style="font-weight:bold">Total Volume: {{@$detail_data[0]->product->cbm}} CBM</span></td>
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
          <td class="tg-wmqn" colspan="2"><span class="a" style="font-weight:bold">Description of goods: </span><span class="a" style="font-weight:normal">{!! @$data->description !!}</span></td>
        </tr>
      </tbody>
      </table>



      <table class="tg-new">
        <thead>
            <tr>
                <th class="tg-new-0pky"><span style="font-weight:bold">Our Order #</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Customer PO#</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">H.S Code</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Article No.</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Size </span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Quantity</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">UOM</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">U/Price</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Amount (USD)</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Nt. Wt.KG.</span></th>
                <th class="tg-new-0pky"><span style="font-weight:bold">Gr. Wt.KG</span></th>
            </tr>
        </thead>
        <tbody>
          @php
              $amount = 0.0;
              $total_amount = 0.0;
          @endphp
          @foreach ($detail_data as $item)
          @php
              $amount = @sprintf("%.3f",@$item->quantity) + @sprintf("%.3f",@$item->article_rate);
              $total_amount += $amount;
          @endphp
          <tr>
            <td class="tg-new-0pky">{{@$data->perfoma_invoice_no_local}}</td>
            <td class="tg-new-0pky">{{@$data->po_number}}</td>
            <td class="tg-new-0pky">{{@$item->product->hs_code}}</td>
            <td class="tg-new-0pky">{{@$item->product->name}}</td>
            <td class="tg-new-0pky">{{@$item->size->name}}</td>
            <td class="tg-new-0pky">{{@$item->quantity}}</td>
            <td class="tg-new-0pky">{{ measurementUnit()[@$item->unit] }}</td>
            <td class="tg-new-0pky">{{@$item->article_rate}}</td>
            <td class="tg-new-0pky">{{@$amount}}</td>
            <td class="tg-new-0pky">{{@$item->product->net_weight_per_carton}}</td>
            <td class="tg-new-0pky">{{@$item->product->gross_weight_per_carton}}</td>
        </tr>
          @endforeach
            
            {{-- <tr>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky">master</td>
                <td class="tg-new-0pky">master</td>
            </tr>
            <tr>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
            </tr>
            <tr>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
            </tr>
            <tr>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
                <td class="tg-new-zv4m"></td>
            </tr> --}}
          </tbody>
          <tfoot>
            <tr>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky">{{@$detail_data->sum('quantity')}}</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky">{{@$total_amount}}</td>
                <td class="tg-new-0pky"></td>
                <td class="tg-new-0pky"></td>
            </tr>
          </tfoot>
        
    </table>
  



  
  <div class="border" style="font-size:12px; padding-left:10px;">
    <p><strong>Amount in Words:</strong> 
      {{amountInWords($total_amount)}}
     {{-- One Crore only --}}
    </p>
    <p>We Certify that the goods are of Pakistan Origin.</p>
    {{-- <p class="b-black" style="font-size:12px;"><?= @$data->europe_shipment; ?></p> --}}
    {{-- <p class="b-black" style="font-size:12px; padding-left:0px;">We need 2 3 lines of dummy data from lorem ipsum</p> --}}
    <p class="b-black-for-goods" style="font-size:12px; padding-left:0px;">{{@$data->europe_shipment}}</p>
  </div>
  <div class="b-black border" style="font-size:12px;" >
    <p ><b style="font-size:12px">BANK DETAILS:</b></p>
    <p style="line-height:0.2px;font-size:12px">Name: {{@$data->customer->company->branch_name}}</p>
    <p style="line-height:0.2px;font-size:12px">Address: {{@$data->customer->company->branch_address}}</p>
    <p style="line-height:0.2px;font-size:12px">Branch Code : {{@$data->customer->company->branch_code}}</p>
    <p style="line-height:0.2px;font-size:12px">Account Name: {{@$data->customer->company->account_name}}</p>
    <p style="line-height:0.2px;font-size:12px">Account Number: {{@$data->customer->company->account_number}}</p>
    <p style="line-height:0.2px;font-size:12px">Iban Number: {{@$data->customer->company->iban_number}}</p>
    <p style="line-height:0.2px;font-size:12px">Swift Code: {{@$data->customer->company->swift_code}}</p>
    {{-- <p style="line-height:0.2px;font-size:12px">Name: Bank name</p>
    <p style="line-height:0.2px;font-size:12px">Address: Address here</p>
    <p style="line-height:0.2px;font-size:12px">Branch Code : Code here</p>
    <p style="line-height:0.2px;font-size:12px">Account Name: Account Name</p>
    <p style="line-height:0.2px;font-size:12px">Account Number: Account Number</p>
    <p style="line-height:0.2px;font-size:12px">Iban Number: Iban Number</p>
    <p style="line-height:0.2px;font-size:12px">Swift Code: Swift Code</p> --}}

  </div>

  {{-- <p class="b-black border" style="font-size:12px;"><?= @$data->customer_specific; ?></p> --}}

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