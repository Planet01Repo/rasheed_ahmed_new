<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $fillable = [
        'company_id',
        'branch_name',
        'branch_address',
        'branch_code',
        'account_name',
        'account_number',
        'iban_number',
        'swift_code'
    ];
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
}
