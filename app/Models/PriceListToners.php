<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PriceList;
use App\Models\Toner;

class PriceListToners extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_list_id',
        'toner_id',
        'price',
    ];

    public function pricelist(){
        return $this->belongsTo(PriceList::class);
    }

    public function toner(){
        return $this->belongsTo(Toner::class);
    }
}
