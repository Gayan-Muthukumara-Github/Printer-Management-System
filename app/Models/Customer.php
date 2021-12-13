<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyPrinter;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'company_name',
        'company_address',
        'city',
        'type',
        'group_entity',
        'phone_number',
        'fax_number',
        'vat',
        'svat',
    ];

    public function company_printers()
    {
        return $this->hasMany(CompanyPrinter::class);
    }

    public function datafeeds()
    {
        return $this->hasMany(Datafeed::class, 'group_id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function customer_requests(){
        return $this->hasMany(CustomerRequest::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

}
