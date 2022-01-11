<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Printer;
use App\Models\Customer;

class CompanyPrinter extends Model
{
    use HasFactory;
    protected $fillable = ["company_id", 
    "customer_id",
    "serial_number",
    "printer_id",
    "status",
    "dip_cost",
    "branch",
    "department",
    "con_method",
    "installation_at",
    "start_page_count",
    "duty_cycle",
    "contract_id",
    "start_page_count_color",
        "printer_model",
        "printer_checked",
        "company_checked",
        "company"];



    public function printer()
    {
        return $this->belongsTo(Printer::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}

