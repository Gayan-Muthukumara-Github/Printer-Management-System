<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toner;
use App\Models\CompanyPrinter;

class Printer extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'brand',
        'port_number',
        'model',
        'image',
        'function',
        'monthly_duty_cycle',
        'recommended_monthly_page_volum',
        'cost',
    ];

    public function toners()
    {
        return $this->hasMany(Toner::class);
    }

    public function company_printers()
    {
        return $this->hasMany(CompanyPrinter::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($printer) {
             $printer->toners()->delete();
             $printer->company_printers()->delete();
        });
    }
}
