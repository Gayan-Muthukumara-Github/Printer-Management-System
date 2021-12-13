<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Ramsey\Collection\Tool\ValueToStringTrait;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DatafeedDetails;
use DB;

class Datafeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'year',
        'month',
        'type',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'group_id');
    }

    public function details()
    {
        return $this->hasMany(DatafeedDetails::class);
    }

    public function droup_by_printer_model()
    {
        $printer_details = DB::table('datafeed_details')
                ->join('company_printers', 'datafeed_details.printer_id', '=', 'company_printers.id')
                 ->select('company_printers.printer_id', DB::raw('count(*) as total'))
                 ->groupBy('company_printers.printer_id')
                 ->get();
        return $printer_details;
    }

    public function com_printer($printer_id)
    {
        return Printer::where('id', '=', $printer_id)->first();
    }

    public function avarage_monochrome($printer_id)
    {
        $datafeed_details = DB::table('datafeed_details')
            ->join('company_printers', 'datafeed_details.printer_id', '=', 'company_printers.id')
            ->join('printers', 'company_printers.printer_id', '=', 'printers.id')
            ->where('printers.id', '=', $printer_id)
            ->select('company_printers.printer_id', DB::raw('count(*) as total'))
            ->count();

        $mono_count = DB::table('datafeed_details')
            ->join('company_printers', 'datafeed_details.printer_id', '=', 'company_printers.id')
            ->join('printers', 'company_printers.printer_id', '=', 'printers.id')
            ->where('printers.id', '=', $printer_id)
            ->select(DB::raw('sum(mono_page_count) as mono_page_count'))->first();

        // $datafeed_details = $this->details->where('printer_id', '=', $printer_id)->count();
        // $mono_count = $this->details->where('printer_id', '=', $printer_id)->sum('mono_page_count');
        return intval($mono_count->mono_page_count)/intval($datafeed_details);
    }

    public function avarage_colour($printer_id)
    {
        $num_printers = DB::table('datafeed_details')
            ->join('company_printers', 'datafeed_details.printer_id', '=', 'company_printers.id')
            ->join('printers', 'company_printers.printer_id', '=', 'printers.id')
            ->where('printers.id', '=', $printer_id)
            ->select('company_printers.printer_id', DB::raw('count(*) as total'))
            ->count();

        $mono_count = DB::table('datafeed_details')
            ->join('company_printers', 'datafeed_details.printer_id', '=', 'company_printers.id')
            ->join('printers', 'company_printers.printer_id', '=', 'printers.id')
            ->where('printers.id', '=', $printer_id)
            ->select(DB::raw('sum(colour_page_count) as colour_page_count'))->first();
        // $num_printers = $this->details->where('printer_id', '=', $printer_id)->count();
        // $mono_count = $this->details->where('printer_id', '=', $printer_id)->sum('colour_page_count');
        return intval($mono_count->colour_page_count)/intval($num_printers);
    }

    public function total_amount_mono($units, $unit_price)
    {
        $commitment = 0;
        if($unit_price->commitment_1){
            return $units * $unit_price->commitment_1 * $unit_price->monochrome;
        }else{
            return $units * $unit_price->commitment * $unit_price->monochrome;
        }
    }

    public function total_amount_colour($units, $unit_price)
    {
        if($unit_price->commitment_1){
            return $units * $unit_price->commitment_1 * $unit_price->color;
        }else{
            return $units * $unit_price->commitment * $unit_price->color;
        }
            
    }

}


