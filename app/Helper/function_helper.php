<?php
use App\Carton;
use App\PerfomaInvoice;
use App\PackingList;

function print_b($print_pre){
    echo "<pre>";
    print_r($print_pre);
    echo "</pre>";
    die;
}


function cartonData() {
  $data = Carton::orderBy('id', 'DESC')->get();
  $array = array();
  foreach( $data as $v)
  {
    $array[$v['id']] = $v['length'].' x '. $v['width'].' x '.$v['height'];
  }
  return $array;
}

function measurementUnit()
{
  $measurementUnit = array(
    0 => "KGS",
    1 => "MTRS",
    2 => "SQ.MTRS",
    3 => "FT",
    4 => "SQ.FT",
    5 => "LTRS",
    6 => "PRS",
    7 => "PCS",
    8 => "DZN",
    9 => "4PK"
  );
  return $measurementUnit;
}

function shippping_method()
{
  $shippping_method = array(
    
    0 => "By Sea",
    1 => "By Air",
    2 => "By Courier",
  );
  return $shippping_method;
}

function cities()
{
  $cities = array(
    
    0 => "Karachi",
    1 => "Zafarwal",
    2 => "Sialkot",
  );
  return $cities;
}

function price_base()
{
  $price_base = array(
    
    0 => "EXW",
    1 => "FOB",
    2 => "CRF",
    3 => "CIF"
  );
  return $price_base;
}

function currency()
{
  $currency = array(
    0 => "USD",
    1 => "EUR",
    2 => "PKR",
    3 => "CAD",
    4 => "GBP"
  );
  return $currency;
}

function perfoma_invoice_no() {
  
  $res = PerfomaInvoice::max('id');
  $num = ($res == '')? 1 : $res+1;
  return sprintf("%05d", $num);;
}

function packing_invoice_no() {
  
  $res = PackingList::max('id');
  $num = ($res == '')? 1 : $res+1;
  return sprintf("%05d", $num);;
}

function amountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
      3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
      7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
      10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
      13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
      16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
      19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
      40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
      70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
        $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
        $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
        $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
        '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
    else $string[] = null;
    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
    " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}

function numberTowords($num)
    {
        
        $ones = array(
        0 =>"ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        );
        $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
        );
  $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
        );
        $num = number_format($num,2,".",",");
        $num_arr = explode(".",$num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",",$wholenum));
        krsort($whole_arr,1);
        $rettxt = "";
        foreach($whole_arr as $key => $i){
            while(substr($i,0,1)=="0")
                $i=substr($i,1,5);
                if($i < 20){
                $rettxt .= @$ones[$i];
                }elseif($i < 100){
                    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
                }else{
                    if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                    if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
                    if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
                }
                if($key > 0){
                    $rettxt .= " ".$hundreds[$key]." ";
                }
        }
  if($decnum > 0){
            $rettxt .= " point ";
            if($decnum < 20){
                $rettxt .= @$ones[$decnum];
            }elseif($decnum < 100){
                $rettxt .= @$tens[substr($decnum,0,1)];
                if($ones[substr($decnum,1,1)] != "ZERO"){
                  $rettxt .= " ".@$ones[substr($decnum,1,1)];
                }
            }
            // $rettxt .= $decnum;
        }
        return $rettxt;
    }

?>
