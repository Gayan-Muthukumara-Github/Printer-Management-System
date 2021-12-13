<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratecard extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "customer_id",
        "type",
        "apply_exchange",
        "exchange_diff",
        "monochrome",
        "print_volume",
        "group_wise",
        "status",
        "user_id",
        "contract_id"
    ];

    public function ratecard_printers()
    {
        return $this->hasMany(RatecardPrinter::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function get_type()
    {
        $type = $this->type;
        $return = "";
        switch ($type) {
            case "BaseClick":
                $return = "Base + Click";
                break;
            case "ClickOnlyAvgTotPMode":
                $return = "Click Only (Avg Total / Printer Model)";
                break;
            case "OnlyEveryP":
                $return = "Click Only (On every printer)";
                break;
            case "OnlyEveryP":
                $return = "Click Only (Entire Printer Fleet)";
                break;
            default:
            $return = "NO TYPE";
          }
          return $return;
    }

    public function ratecard_printer_monochrome($page_count)
    {   
        if($this->type == "BaseClick"){
            $ratecard_printer = $this->ratecard_printers->where('commitment', '>', $page_count)->sortByDesc('commitment')->first();
        }else{
            $ratecard_printer = $this->ratecard_printers->where('commitment_1', '>', $page_count)->sortByDesc('commitment_1')->first();
        }
        
        return $ratecard_printer;
    }

    public function ratecard_printer_color($page_count)
    {
        if($this->type == "BaseClick"){
            $ratecard_printer = $this->ratecard_printers->where('commitment', '>', $page_count)->sortByDesc('commitment')->first();
        }else{
            $ratecard_printer = $this->ratecard_printers->where('commitment_1', '>', $page_count)->sortByDesc('commitment_1')->first();
        }
        return $ratecard_printer;
    }


}
