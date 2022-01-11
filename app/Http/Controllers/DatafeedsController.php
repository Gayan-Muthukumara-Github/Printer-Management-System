<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Datafeed;
use App\Models\DatafeedDetails;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\FilteredDatafeedDetails;
use App\Models\CompanyPrinter;



class DatafeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function datafeed(Request $request)
    {
        $csvFile = fopen(request()->file('datafeedfile'), "r");

        fgetcsv($csvFile);
        $row = fgetcsv($csvFile);

        $date_from_csv = $row[4];
        $dt2 = new DateTime($date_from_csv);
        $date2= $dt2->format('Y-m-d');

        $date_from_text = $request->date;
        $dt1 = new DateTime($date_from_text);
        $date1= $dt1->format('Y-m-d');

        if($date1 == $date2){

            while (($row = fgetcsv($csvFile)) !== FALSE) {


                DatafeedDetails::create([
                    'datafeed_id' => "0",
                    'customer_id' => "0",
                    'printer_id' => "0",
                    'total_page_count' => intval($row[5]),
                    'mono_page_count' => intval($row[11]),
                    'colour_page_count' => intval($row[7]),
                    'serial_number' => $row[1],
                    'date' => $request->date,
                ]);

                $printer = CompanyPrinter::where([['company_id', "=",Auth::user()->company_id], ['serial_number', '=', $row[1]]])->first();
                if($printer != null) {
                    if ($printer->printer_id != null){
                        FilteredDatafeedDetails::create([
                            'datafeed_id' => "000",
                            'company_id' => $printer->company_id,
                            'branch' => $printer->company,
                            'date' => $request->date,
                            'customer_id' => $printer->customer_id,
                            'printer_id' => $printer->printer_id,
                            'total_page_count' => intval($row[5]),
                            'mono_page_count' => intval($row[11]),
                            'colour_page_count' => intval($row[7]),
                        ]);
                    }
                }

            }
            DB::table('datafeed_details')->delete();
        }
        else{
            echo '<script type ="text/JavaScript">';
            echo 'alert("Date does not match")';
            echo '</script>';
        }
        return redirect('/datafeed');

    }
    public function index(){

        $printers_received = FilteredDatafeedDetails::where('company_id', '=', Auth::user()->company_id)->get();
        $printers = CompanyPrinter::where('company_id', '=', Auth::user()->company_id)->get();
        $customers = Customer::where('company_id', '=', Auth::user()->company_id)->get();

        $all_customers = $customers->groupBy('customer_name')->count();
        $total_printers = $printers->count();
        $received_printers = $printers_received->count();

        return view('datafeed.index',[
            'all_customers' => $all_customers,
            'total_printers' => $total_printers,
            'received_printers' => $received_printers
        ]);

    }
//
//    public function store(Request $request){
////        $group_id = 0;
////        $company_id = Auth::user()->company_id;
////        $csvFile = fopen(request()->file('datafeedfile'), "r");
////        fgetcsv($csvFile);
////        while(($row = fgetcsv($csvFile)) !== FALSE){
////            $group = Customer::where([['company_id', "=",Auth::user()->company_id], ['company_name', '=', $row[1]]])->first();
////            $customer = Customer::where([['company_id', "=",Auth::user()->company_id], ['company_name', '=', $row[2]]])->first();
////            if($customer && $group){
////                $printer = CompanyPrinter::where([['customer_id', "=",$group->id],['serial_number', "=", $row[4]]])->first();
////                if($printer ){
////                    if($group_id == 0){
////                        $group_id = $group->id;
////                        $datafeed = Datafeed::create([
////                            'group_id' => $group->id,
////                            'year' => $request->year,
////                            'month' => $request->month,
////                            'type' => $request->datafeedtype,
////                            'company_id' => $company_id,
////                        ]);
////                    }
////
////                    if($printer && $customer){
////                        $prv_mono_count = intval($printer->start_page_count) - intval($printer->start_page_count_color);
////                        DatafeedDetails::create([
////                            'datafeed_id' => $datafeed->id,
////                            'customer_id' => $customer->id,
////                            'printer_id' => $printer->id,
////                            'previous_page_count' => intval($printer->start_page_count),
////                            'total_page_count' => intval($row[7]),
////                            'previous_mono_page_count' => intval($prv_mono_count),
////                            'previous_colour_page_count' => intval($printer->start_page_count_color),
////                            'mono_page_count' => intval($row[8]),
////                            'colour_page_count' => intval($row[9]),
////                        ]);
////                    }
////                }
////            }
////        }
//        return redirect('/datafeed');
//
//    }
}
