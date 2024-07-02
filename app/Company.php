<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    protected $fillable = ['title', 'prefix', 'pi_prefix', 'invoice_prefix', 'address'];

    public function customer()
    {
        return $this->hasMany('App\Customer', 'company_id', 'id');
    }

    public function companyDetails()
    {
        return $this->hasMany('App\CompanyDetail', 'company_id', 'id');
    }
}

