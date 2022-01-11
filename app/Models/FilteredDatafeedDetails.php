<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilteredDatafeedDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'datafeed_id',
        'customer_id',
        'printer_id',
        'total_page_count',
        'mono_page_count',
        'colour_page_count',
        'date',
        'company_id',
        'branch',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'company_id');
    }


}
