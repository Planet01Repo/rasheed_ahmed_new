<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model {
    public function material()
    {
        return $this->belongsTo('App\Material', 'material_id', 'id');
    }    
}

