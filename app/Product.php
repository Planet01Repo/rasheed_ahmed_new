<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;


    protected $fillable = ['master_carton_dimension'];

    public function images()
    {
        return $this->hasMany('App\Image', 'product_id', 'id');
    }
    public function productmaterial()
    {
        return $this->hasMany('App\ProductMaterial', 'product_id', 'id');
    }
    public function productsize()
    {
        return $this->hasMany('App\ProductSize', 'product_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }
}