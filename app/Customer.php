<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    protected $fillable = ['bill_to', 'price_base', 'payment_terms', 'europe_shipment', 'credit_days', 'customer_code','company_detail_id'];

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }  
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }  
    public function companyDetails()
    {
        return $this->belongsTo('App\CompanyDetail', 'company_detail_id', 'id');
    }  
}

