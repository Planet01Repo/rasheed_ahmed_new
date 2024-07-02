<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PackingListDetail extends Model {
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    } 

    public function size()
    {
        return $this->belongsTo('App\Size', 'size_id', 'id');
    } 

    /**
     * Get the packingList that owns the PackingListDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function packingList()
    {
        return $this->belongsTo('App\PackingList', 'packing_list_id', 'id');
    }
}

