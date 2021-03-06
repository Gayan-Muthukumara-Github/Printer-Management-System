<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatafeedDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'datafeed_id',
        'customer_id',
        'printer_id',
        'total_page_count',
        'mono_page_count',
        'colour_page_count',
        'serial_number',
        'date',
    ];

    public function company_printer()
    {
        return $this->belongsTo(CompanyPrinter::class, 'printer_id');
    }



}
