<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceCreationDetail extends Model
{
    protected $fillable = [
        'invoice_creation_id',
        'perfoma_invoice_id',
        'perfoma_invoice_detail_id',
        'quantity',
    ];

    /**
     * Get the user that owns the InvoiceCreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perfomaInvoice()
    {
        return $this->belongsTo('App\PerfomaInvoice', 'perfoma_invoice_id', 'id');
    }
    
    public function perfomaInvoiceDetail()
    {
        return $this->belongsTo('App\PerfomaInvoiceDetail', 'perfoma_invoice_detail_id', 'id');
    }
}
