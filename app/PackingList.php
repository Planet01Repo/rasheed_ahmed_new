<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PackingList extends Model {

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
    public function packinglistdetail()
    {
        return $this->hasMany('App\PackingListDetail', 'packing_list_id', 'id');
    } 

    /**
     * Get the user that owns the PackingList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoiceCreation()
    {
        return $this->belongsTo('App\InvoiceCreation', 'invoice_creation_id', 'id');
    }
}

