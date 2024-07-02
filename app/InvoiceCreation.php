<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceCreation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'invoice_no',
        'invoice_creation_date',
        'shipped_per',
        'awb_no',
        'awb_date',
        'form_no',
        'form_date',
        'quantity',
        'no_of_package',
        'volume',
        'amount_in_words',
        'description',
        'customer_specific',
        'freight_rate',
        'company_detail_id',
        'ship_to'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    /**
     * Get all of the comments for the InvoiceCreation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoiceCreationDetail()
    {
        return $this->hasMany('App\InvoiceCreationDetail', 'invoice_creation_id', 'id');
    }

    public function companyDetails()
    {
        return $this->belongsTo('App\CompanyDetail', 'company_detail_id', 'id');
    }
}