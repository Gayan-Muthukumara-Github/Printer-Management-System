<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatecardPrinter extends Model
{
    use HasFactory;
    protected $fillable = [
        "ratecard_id",
        "printr_id",
        "commitment",
        "commitment_1",
        "monochrome",
        "color"
    ];


    public function ratecard()
    {
        return $this->belongsTo(Ratecard::class);
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class, 'printr_id');
    }
}
