<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model {

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id', 'id');
    }
    public function purchase_order_detail()
    {
        return $this->hasMany('App\PurchaseOrderDetail', 'po_id', 'id');
    } 
}

