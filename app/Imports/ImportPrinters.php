<?php

namespace App\Imports;

use App\Models\CompanyPrinter;
use App\Models\Printer;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class ImportPrinters implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { 
        $printer = Printer::where([['company_id', "=",Auth::user()->company_id], ['model', "=", $row[3]]])->first();
        if($printer){
            return new CompanyPrinter([
                'name'     => $row[0],
                "company_id"=> Auth::user()->company_id,
                "serial_number"=> $row[2],
                "printer_model" =>$row[1],
                "status"=> $row[4],
                "dip_cost"=> "N/A",
                "branch"=> $row[7],
                "department"=> $row[8],
                "con_method"=> $row[9],
                "installation_at"=> $row[10],
                "start_page_count"=> $row[11],
                "duty_cycle"=> "N/A",
                "printer_id" => "N/A",
                "printer_checked" => 0,
                "company_checked" =>0,
                "company" => $row[6]
            ]);
        }
    }
}
