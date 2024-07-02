<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PerfomaInvoiceDetail extends Model {
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    } 

    public function size()
    {
        return $this->belongsTo('App\Size', 'size_id', 'id');
    } 
    
    public function perfomaInvoice()
    {
        return $this->belongsTo('App\PerfomaInvoice', 'perfoma_invoice_id', 'id');
    } 

}

