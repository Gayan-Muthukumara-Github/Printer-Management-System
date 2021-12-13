<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PriceListToners;
use App\Models\Contract;
use App\Models\Printer;
use App\Models\Company;

class PriceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'contract_id',
        'printer_id',
        'currency',
        'price',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }    
    
    public function contract(){
        return $this->belongsTo(Contract::class);
    }

    public function printer(){
        return $this->belongsTo(Printer::class);
    }
    public function toner_lists(){
        return $this->hasMany(PriceListToners::class);
    }
}
