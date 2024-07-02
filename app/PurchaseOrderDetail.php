<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model {
    public function po_material()
    {
        return $this->belongsTo('App\PoMaterial', 'po_material_id', 'id');
    } 

}

