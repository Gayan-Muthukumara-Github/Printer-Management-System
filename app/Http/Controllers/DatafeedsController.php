<?php

namespace App\Http\Controllers;

use App\Models\Datafeed;
use App\Models\DatafeedDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyPrinter;
use App\Models\Customer;

class DatafeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $datafeeds = Datafeed::where('company_id', '=', Auth::user()->company_id)->get();
        return view('datafeed.index',[
            'datafeeds' => $datafeeds
        ]);
    }

    public function store(Request $request){
        $group_id = 0;
        $company_id = Auth::user()->company_id;
        $csvFile = fopen(request()->file('datafeedfile'), "r");
        fgetcsv($csvFile);   
        while(($row = fgetcsv($csvFile)) !== FALSE){
            $group = Customer::where([['company_id', "=",Auth::user()->company_id], ['company_name', '=', $row[1]]])->first();
            $customer = Customer::where([['company_id', "=",Auth::user()->company_id], ['company_name', '=', $row[2]]])->first();
            if($customer && $group){
                $printer = CompanyPrinter::where([['customer_id', "=",$group->id],['serial_number', "=", $row[4]]])->first();
                if($printer ){
                    if($group_id == 0){
                        $group_id = $group->id;
                        $datafeed = Datafeed::create([
                            'group_id' => $group->id,
                            'year' => $request->year,
                            'month' => $request->month,
                            'type' => $request->datafeedtype,
                            'company_id' => $company_id,
                        ]);
                    }
                    
                    if($printer && $customer){
                        $prv_mono_count = intval($printer->start_page_count) - intval($printer->start_page_count_color);
                        DatafeedDetails::create([
                            'datafeed_id' => $datafeed->id,
                            'customer_id' => $customer->id,
                            'printer_id' => $printer->id,
                            'previous_page_count' => intval($printer->start_page_count),
                            'total_page_count' => intval($row[7]),
                            'previous_mono_page_count' => intval($prv_mono_count),
                            'previous_colour_page_count' => intval($printer->start_page_count_color),
                            'mono_page_count' => intval($row[8]),
                            'colour_page_count' => intval($row[9]),
                        ]);
                    }
                }
            }
        }
        return redirect('/datafeed');

    }
}
