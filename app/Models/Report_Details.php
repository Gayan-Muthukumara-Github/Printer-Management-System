<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_Details extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'branch',
        'printer_id',
        'printer_model',
        'no_of_units',
        'total_mono',
        'total_color',
        'mono_value',
        'color_value',
        'total_mono_price',
        'total_color_price',
        'exchange_total'
    ];
}
