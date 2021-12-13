<?php

namespace App\Imports;

use App\Models\CompanyPrinter;
use App\Models\TempCompanyPrinter;
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
            return new TempCompanyPrinter([
                'name'     => $row[0],
                "company_id"=> Auth::user()->company_id,
                "serial_number"=> $row[2],
                "printer_model" =>$row[1],
                "status"=> $row[4],
                "dip_cost"=> $row[5],
                "branch"=> $row[6],
                "department"=> $row[7],
                "con_method"=> $row[8],
                "installation_at"=> $row[9],
                "start_page_count"=> $row[10],
                "duty_cycle"=> $row[11],
                "printer_id" => "N/A",
            ]);
        }
    }
}
