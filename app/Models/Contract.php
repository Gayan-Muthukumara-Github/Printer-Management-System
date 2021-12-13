<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CompanyPrinter;
use App\Models\RatecardPrinter;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        "contract_id",
        "name",
        "company_id",
        "customer_id",
        "contract_type",
        "master_contract",
        "monthly_commitment",
        "contract_signed_at",
        "exchange_rate",
        "rate_card_id",
        "service_level",
        "contract_contact_person",
        "upload",
        "salient_point_1",
        "salient_point_2",
        "salient_point_3",
        "salient_point_4",
        "salient_point_5",
        "salient_point_6",
        "salient_point_7",
        "salient_point_8",
        "salient_point_9",
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function company_printers()
    {
        return $this->hasMany(CompanyPrinter::class);
    }

    public function ratecard()
    {
        return $this->hasOne(Ratecard::class);
    }

    public function mainPrinters(){

        $printer_ids = $this->company_printers->pluck('printer_id')->toArray();
        $printers = Printer::whereIn('id', $printer_ids)->get();
        return $printers;
    }
}
