<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfomaInvoice extends Model {

    use SoftDeletes;

    protected $fillable = ['processed_at','freight_rate'];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
    public function perfomainvoicedetail()
    {
        return $this->hasMany('App\PerfomaInvoiceDetail', 'perfoma_invoice_id', 'id');
    } 
}

