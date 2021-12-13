<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Printer;

class DatafeedDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'datafeed_id',
        'customer_id',
        'printer_id',
        'previous_page_count',
        'total_page_count',
        'previous_mono_page_count',
        'previous_colour_page_count',
        'mono_page_count',
        'colour_page_count',
    ];

    public function company_printer()
    {
        return $this->belongsTo(CompanyPrinter::class, 'printer_id');
    }


}
