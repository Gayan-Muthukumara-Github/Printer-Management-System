<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Datafeed;
use App\Models\Report_Details;
use App\Models\Printer;
use App\Models\Ratecard;
use App\Models\Contract;
use App\Models\RatecardPrinter;
use App\Models\DatafeedDetails;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Customer::where([['company_id', "=", Auth::user()->company_id], ['type', '=', 'Company']])->get();
        $groups = Customer::where([['company_id', "=", Auth::user()->company_id], ['type', '=', 'Group']])->get();
        $contracts = Contract::where('company_id', "=", Auth::user()->company_id)->get();
        $ccustomers = DB::table('contracts')
            ->selectRaw('*')
            ->join('customers', 'contracts.customer_id', '=', 'customers.id')
            ->where('contracts.company_id', '=', Auth::user()->company_id)
            ->get();

        return view('reports.index', [
            'companies' => $companies,
            'groups' => $groups,
            'contracts' => $contracts,
            'ccustomers' => $ccustomers
        ]);
    }

    public function generate(Request $request)
    {
        $pdf = 0;
        $customer_id = DB::select("select id from customers where company_name = '$request->companyname'");
        foreach ($customer_id as $id){
            $ratecard = DB::select("select * from ratecards where status = 'active' and customer_id='$id->id'");
            $data = [];
            if($ratecard){
                foreach ($ratecard as $r) {
                    if ($r->type == "BaseClick") {
                        $customer = Customer::where('company_name', '=', $request->companyname)->get();

                        $date_from_text = $request->date;
                        $dt = new DateTime($date_from_text);
                        $date = $dt->format('Y-m-d');

                        $m = DateTime::createFromFormat("Y-m-d", $date);
                        $month = $m->format("m");
                        $year = $m->format("Y");
                        $s_date = $year.'-'.$month.'-'.'01';

                        $date_today = Carbon::now();
                        $date_today->toDateString();

                        $sub_Tot_Base_Commit = 0;
                        $sub_Tot_MonoCharges = 0;
                        $sub_Tot_ColorCharges = 0;

                        foreach ($customer_id as $id) {
                            $contract = Contract::where('customer_id', '=', $id->id)->get();
                            $invoice = DB::select("SELECT
                                                        printer_id,
                                                        model,
                                                        COUNT(printer_id) AS Num_PRNT,
                                                        ratecard_printers.commitment AS commitment,
                                                        (
                                                            COUNT(printer_id) * ratecard_printers.commitment
                                                        ) AS Tot_Base_Commit,
                                                        SUM(mono_page_count) AS Tot_Mono,
                                                        ratecard_printers.monochrome AS monochrome,
                                                        (
                                                            SUM(mono_page_count) * ratecard_printers.monochrome
                                                        ) AS Tot_MonoCharges,
                                                        SUM(colour_page_count) AS Tot_Color,
                                                        ratecard_printers.color AS color,
                                                        (
                                                            SUM(colour_page_count) * ratecard_printers.color
                                                        ) AS Tot_ColorCharges
                                                    FROM
                                                        filtered_datafeed_details,
                                                        ratecard_printers,
                                                        ratecards,
                                                        printers
                                                    WHERE
                                                        ratecards.id = ratecard_printers.ratecard_id AND ratecards.status = 'active' AND filtered_datafeed_details.printer_id = ratecard_printers.printr_id AND ratecard_printers.printr_id = printers.id AND filtered_datafeed_details.date BETWEEN '$s_date' AND '$date' AND filtered_datafeed_details.customer_id = '$id->id'
                                                    GROUP BY
                                                        printer_id;");

                        }


                        foreach ($invoice as $i) {
                            $sub_Tot_Base_Commit = $sub_Tot_Base_Commit + $i->Tot_Base_Commit;
                            $sub_Tot_MonoCharges = $sub_Tot_MonoCharges + $i->Tot_MonoCharges;
                            $sub_Tot_ColorCharges = $sub_Tot_ColorCharges + $i->Tot_ColorCharges;

                        }
                        $Sub_Total = $sub_Tot_ColorCharges + $sub_Tot_MonoCharges + $sub_Tot_Base_Commit;
                        $Tax = $Sub_Total * 0.08;
                        $Total_Amount = $Sub_Total + $Tax;
                        $data = [
                            'customer' => $customer,
                            'contract' => $contract,
                            'invoice' => $invoice,
                            'subtotal' => $Sub_Total,
                            'tax' => $Tax,
                            'totalamount' => $Total_Amount,
                            'date_today' => $date_today
                        ];
                        $pdf = PDF::loadView('reports.show', $data);
                        DB::table('report__details')->delete();
                        return $pdf->download('printers.pdf');

                    }

                    elseif ($r->type == "ClickOnlyAvgTotPMode") {
                        $customer = Customer::where('company_name', '=', $request->companyname)->get();
                        $customer_id = DB::select("select id from customers where company_name = '$request->companyname'");

                        $date_from_text = $request->date;
                        $dt = new DateTime($date_from_text);
                        $date = $dt->format('Y-m-d');

                        $date_today = Carbon::now();
                        $date_today->toDateString();

                        $sub_Tot_MonoCharges = 0;
                        $sub_Tot_ColorCharges = 0;
                        $pcount = 0;

                        foreach ($customer_id as $id)
                        {
                            if($r->group_wise == 0)
                            {

                                $contract = Contract::where('customer_id', '=', $id->id)->get();
                                $printers_details = DB::select("SELECT
                                                            ratecard_printers.printr_id as printer_id,
                                                            COUNT(ratecard_printers.printr_id) as printer_count
                                                        FROM
                                                            ratecard_printers
                                                        JOIN(
                                                            SELECT
                                                                printer_id
                                                            FROM
                                                                filtered_datafeed_details
                                                            GROUP BY
                                                                printer_id
                                                        ) q
                                                        ON
                                                          ratecard_printers.printr_id = q.printer_id
                                                          WHERE ratecard_printers.ratecard_id = (SELECT id FROM ratecards WHERE ratecards.status = 'active' AND ratecards.customer_id='$id->id')
                                                        GROUP BY
                                                        ratecard_printers.printr_id
                                                        ORDER BY
                                                        ratecard_printers.printr_id;");


                                foreach ($printers_details as $pd)
                                {

                                    $commitments = DB::select("SELECT
                                                            ratecard_printers.printr_id,
                                                            ratecard_printers.commitment as commitment,
                                                            ratecard_printers.monochrome as mono,
                                                            ratecard_printers.color as color,
                                                            q.Tot_Mono as Tot_Mono,
                                                            q.Tot_Color as Tot_Color,
                                                            q.Num_PRNT as Num_PRNT,
                                                            q.Avg_Mono as Avg_Mono,
                                                            q.Avg_Color as Avg_Color
                                                        FROM
                                                            ratecard_printers
                                                        JOIN(
                                                            SELECT
                                                                printer_id,
                                                                COUNT(printer_id) AS Num_PRNT,
                                                                SUM(mono_page_count) as Tot_Mono,
                                                                SUM(colour_page_count) as Tot_Color,
                                                                SUM(mono_page_count) / COUNT(printer_id) AS Avg_Mono,
                                                                SUM(colour_page_count) / COUNT(printer_id) AS Avg_Color

                                                            FROM
                                                                filtered_datafeed_details
                                                            GROUP BY
                                                                printer_id
                                                        ) q
                                                        ON
                                                          ratecard_printers.printr_id = q.printer_id
                                                          WHERE ratecard_printers.ratecard_id = (SELECT id FROM ratecards WHERE ratecards.status = 'active' AND ratecards.customer_id='$id->id') AND ratecard_printers.printr_id = '$pd->printer_id'

                                                        ORDER BY
                                                        ratecard_printers.printr_id;");

                                    $volumeA = [];
                                    $volumeB = [];
                                    $volumeC = [];
                                    $Avg_Mono = 0;
                                    $Avg_Color = 0;
                                    $Num_Print = 0;
                                    $Tot_Mono = 0;
                                    $Tot_Color = 0;
                                    $mono_min = 0;
                                    $color_min = 0;
                                    $mono = 0;
                                    $color = 0;
                                    $E_charges = 0;
                                    $exchnage_total = 0;
                                    $pcount = $pd->printer_count;


                                    foreach ($commitments as $c) {
                                        array_push($volumeA, $c->commitment);
                                        array_push($volumeB, $c->mono);
                                        array_push($volumeC, $c->color);
                                        $Avg_Mono = $c->Avg_Mono;
                                        $Avg_Color = $c->Avg_Color;
                                        $Num_Print = $c->Num_PRNT;
                                        $Tot_Mono = $c->Tot_Mono;
                                        $Tot_Color = $c->Tot_Color;

                                    }
                                    for ($i = 0; $i < $pcount; $i++) {
                                        $min = $volumeA[$i];
                                        $mono_min = $volumeB[$i];
                                        $color_min = $volumeC[$i];

                                        if ($i == $pcount - 1) {
                                            $max = $volumeA[$pcount];

                                        } else {
                                            $max = $volumeA[$i + 1];

                                        }

                                        if ($Avg_Mono < $min) {
                                            $sub_Tot_MonoCharges = $min * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $sub_Tot_ColorCharges + $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono == $min) {
                                            $sub_Tot_MonoCharges = $min * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono > $min && $Avg_Mono < $max) {
                                            $sub_Tot_MonoCharges = $Avg_Mono * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono > $volumeA[$pcount - 1]) {
                                            $sub_Tot_MonoCharges = $Avg_Mono * $volumeB[$pcount - 1] * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $volumeC[$pcount - 1] * $Num_Print;
                                            $mono = $volumeB[$pcount - 1];
                                            $color = $volumeC[$pcount - 1];
                                            break;
                                        }
                                    }
                                    $exchange = DB::select("SELECT print_volume FROM ratecards WHERE ratecards.status = 'active' AND ratecards.customer_id = '$id->id';");
                                    foreach ($exchange as $e){
                                        $E_charges = $e->print_volume;
                                    }

                                    $exchnage_total = $sub_Tot_MonoCharges + ($sub_Tot_MonoCharges * (1 + ($E_charges * 0.01)));

                                    $printemodel = DB::select("SELECT model FROM printers WHERE id = '$pd->printer_id';");

                                    foreach ($printemodel as $m) {
                                        $printer_model = $m->model;

                                        $report = Report_Details::create([
                                            'printer_id' => $pd->printer_id,
                                            'printer_model' => $printer_model,
                                            'no_of_units' => $Num_Print,
                                            'total_mono' => $Tot_Mono,
                                            'total_color' => $Tot_Color,
                                            'mono_value' => $mono,
                                            'color_value' => $color,
                                            'total_mono_price' => $sub_Tot_MonoCharges,
                                            'total_color_price' => $sub_Tot_ColorCharges,
                                            'exchange_total' => $exchnage_total
                                        ]);
                                    }

                                }

                                $total = DB::select("SELECT SUM(exchange_total) AS exchange_total, SUM(total_color_price) AS total_color_price FROM report__details;");
                                $Tot_MonoCharges = 0;
                                $Tot_ColorCharges = 0;
                                foreach ($total as $t) {
                                    $Tot_MonoCharges = $t->exchange_total;
                                    $Tot_ColorCharges = $t->total_color_price;
                                }

                                $Sub_Total = $Tot_MonoCharges + $Tot_ColorCharges;
                                $Tax = $Sub_Total * 0.08;
                                $Total_Amount = $Sub_Total + $Tax;
                                $report = DB::select("SELECT * FROM report__details;");
                                $data = [
                                    'customer' => $customer,
                                    'contract' => $contract,
                                    'subtotal' => $Sub_Total,
                                    'tax' => $Tax,
                                    'report' => $report,
                                    'totalamount' => $Total_Amount,
                                    'date_today' => $date_today
                                ];
                                $pdf = PDF::loadView('reports.report', $data);
                                DB::table('report__details')->delete();
                                return $pdf->download('printers.pdf');
                            }
                            else if($r->group_wise == 1){

                                $contract = Contract::where('customer_id', '=', $id->id)->get();
                                $printers_details = DB::select("SELECT
                                                                q.customer_id as customer_id,
                                                                q.branch as barnch,
                                                                q.printer_id as printer_id
                                                            FROM
                                                                ratecard_printers
                                                            JOIN(
                                                                SELECT
                                                                    customer_id,
                                                                    branch,
                                                                    printer_id
                                                                FROM
                                                                    filtered_datafeed_details
                                                                WHERE
                                                                    customer_id = '$id->id'
                                                                GROUP BY
                                                                    branch,
                                                                    printer_id
                                                            ) q
                                                            ON
                                                                ratecard_printers.printr_id = q.printer_id
                                                            WHERE
                                                                ratecard_printers.ratecard_id =(
                                                                SELECT
                                                                    id
                                                                FROM
                                                                    ratecards
                                                                WHERE
                                                                    ratecards.status = 'active' AND ratecards.customer_id = '$id->id'
                                                            )
                                                            GROUP BY
                                                            q.printer_id,q.branch
                                                            ORDER BY
                                                                q.branch,
                                                                ratecard_printers.printr_id;");


                                foreach ($printers_details as $pd)
                                {

                                    $commitments = DB::select("SELECT
                                                                q.customer_id,
                                                                q.branch as branch,
                                                                ratecard_printers.printr_id,
                                                                ratecard_printers.commitment AS commitment,
                                                                ratecard_printers.monochrome AS mono,
                                                                ratecard_printers.color AS color,
                                                                q.Tot_Mono AS Tot_Mono,
                                                                q.Tot_Color AS Tot_Color,
                                                                q.Num_PRNT AS Num_PRNT,
                                                                q.Avg_Mono AS Avg_Mono,
                                                                q.Avg_Color AS Avg_Color
                                                            FROM
                                                                ratecard_printers
                                                            JOIN(
                                                                SELECT
                                                                    customer_id,
                                                                    branch,
                                                                    printer_id,
                                                                    COUNT(printer_id) AS Num_PRNT,
                                                                    SUM(mono_page_count) AS Tot_Mono,
                                                                    SUM(colour_page_count) AS Tot_Color,
                                                                    SUM(mono_page_count) / COUNT(printer_id) AS Avg_Mono,
                                                                    SUM(colour_page_count) / COUNT(printer_id) AS Avg_Color
                                                                FROM
                                                                    filtered_datafeed_details
                                                                WHERE
                                                                    customer_id = '$id->id'
                                                                GROUP BY
                                                                    branch,
                                                                    printer_id
                                                            ) q
                                                            ON
                                                                ratecard_printers.printr_id = q.printer_id
                                                            WHERE
                                                                ratecard_printers.ratecard_id =(
                                                                SELECT
                                                                    id
                                                                FROM
                                                                    ratecards
                                                                WHERE
                                                                    ratecards.status = 'active' AND ratecards.customer_id = '$id->id'
                                                            ) AND ratecard_printers.printr_id = '$pd->printer_id' AND q.branch = '$pd->barnch'
                                                            ORDER BY
                                                                q.branch,
                                                                ratecard_printers.printr_id;");

                                    $volumeA = [];
                                    $volumeB = [];
                                    $volumeC = [];
                                    $Avg_Mono = 0;
                                    $Avg_Color = 0;
                                    $Num_Print = 0;
                                    $Tot_Mono = 0;
                                    $Tot_Color = 0;
                                    $mono_min = 0;
                                    $color_min = 0;
                                    $mono = 0;
                                    $color = 0;
                                    $E_charges = 0;
                                    $exchnage_total = 0;
                                    $branch = "";
                                    $pcount = 0;


                                    foreach ($commitments as $c) {
                                        array_push($volumeA, $c->commitment);
                                        array_push($volumeB, $c->mono);
                                        array_push($volumeC, $c->color);
                                        $Avg_Mono = $c->Avg_Mono;
                                        $Avg_Color = $c->Avg_Color;
                                        $Num_Print = $c->Num_PRNT;
                                        $Tot_Mono = $c->Tot_Mono;
                                        $Tot_Color = $c->Tot_Color;
                                        $branch = $c->branch;
                                        $pcount = $pcount + 1;

                                    }
                                    $pcount = count($volumeA);
                                    for ($i = 0; $i < $pcount; $i++) {
                                        $min = $volumeA[$i];
                                        $mono_min = $volumeB[$i];
                                        $color_min = $volumeC[$i];

                                        if ($i == $pcount - 1) {
                                            $max = $volumeA[$pcount-1];

                                        } else {
                                            $max = $volumeA[$i + 1];

                                        }

                                        if ($Avg_Mono < $min) {
                                            $sub_Tot_MonoCharges = $min * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $sub_Tot_ColorCharges + $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono == $min) {
                                            $sub_Tot_MonoCharges = $min * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono > $min && $Avg_Mono < $max) {
                                            $sub_Tot_MonoCharges = $Avg_Mono * $mono_min * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $color_min * $Num_Print;
                                            $mono = $mono_min;
                                            $color = $color_min;
                                            break;
                                        } elseif ($Avg_Mono > $volumeA[$pcount - 1]) {
                                            $sub_Tot_MonoCharges = $Avg_Mono * $volumeB[$pcount - 1] * $Num_Print;
                                            $sub_Tot_ColorCharges = $Avg_Color * $volumeC[$pcount - 1] * $Num_Print;
                                            $mono = $volumeB[$pcount - 1];
                                            $color = $volumeC[$pcount - 1];
                                            break;
                                        }
                                    }
                                    $exchange = DB::select("SELECT print_volume FROM ratecards WHERE ratecards.status = 'active' AND ratecards.customer_id = '$id->id';");
                                    foreach ($exchange as $e){
                                        $E_charges = $e->print_volume;
                                    }

                                    $exchnage_total = $sub_Tot_MonoCharges + ($sub_Tot_MonoCharges * (1 + ($E_charges * 0.01)));

                                    $printemodel = DB::select("SELECT model FROM printers WHERE id = '$pd->printer_id';");

                                    foreach ($printemodel as $m) {
                                        $printer_model = $m->model;

                                        $report = Report_Details::create([
                                            'customer_id' => $id->id,
                                            'branch' =>$branch,
                                            'printer_id' => $pd->printer_id,
                                            'printer_model' => $printer_model,
                                            'no_of_units' => $Num_Print,
                                            'total_mono' => $Tot_Mono,
                                            'total_color' => $Tot_Color,
                                            'mono_value' => $mono,
                                            'color_value' => $color,
                                            'total_mono_price' => $sub_Tot_MonoCharges,
                                            'total_color_price' => $sub_Tot_ColorCharges,
                                            'exchange_total' => $exchnage_total
                                        ]);
                                    }

                                }

                                $total = DB::select("SELECT exchange_total, total_color_price FROM report__details;");
                                $Tot_MonoCharges = 0;
                                $Tot_ColorCharges = 0;
                                foreach ($total as $t) {
                                    $Tot_MonoCharges = $t->exchange_total;
                                    $Tot_ColorCharges = $t->total_color_price;
                                    $Sub_Total = $Tot_MonoCharges + $Tot_ColorCharges;
                                    $Tax = $Sub_Total * 0.08;
                                    $Total_Amount = $Sub_Total + $Tax;
                                    $report = DB::select("SELECT * FROM report__details;");
                                    $data = [

                                        'customer' => $customer,
                                        'contract' => $contract,
                                        'subtotal' => $Sub_Total,
                                        'tax' => $Tax,
                                        'report' => $report,
                                        'totalamount' => $Total_Amount,
                                        'date_today' => $date_today
                                    ];
                                    $pdf = PDF::loadView('reports.C_report', $data);
                                    DB::table('report__details')->delete();
                                    return $pdf->download('printers.pdf');
                                }



                            }
                        }

                    }

                    elseif ($r->type == "OnlyEveryP") {
                        $customer = Customer::where('company_name', '=', $request->companyname)->get();
                        $customer_id = DB::select("select id from customers where company_name = '$request->companyname'");
                        $date_from_text = $request->date;
                        $dt = new DateTime($date_from_text);
                        $date = $dt->format('Y-m-d');

                        $date_today = Carbon::now();
                        $date_today->toDateString();

                        $sub_Tot_Base_Commit = 0;
                        $sub_Tot_MonoCharges = 0;
                        $sub_Tot_ColorCharges = 0;

                        foreach ($customer_id as $id) {
                            $contract = Contract::where('customer_id', '=', $id->id)->get();
                            $invoice = DB::select("Select printer_id,model,COUNT(printer_id) as Num_PRNT,ratecard_printers.commitment as commitment, (COUNT(printer_id) * ratecard_printers.commitment) as Tot_Base_Commit, SUM(mono_page_count) as Tot_Mono, ratecard_printers.monochrome as monochrome, (SUM(mono_page_count) * ratecard_printers.monochrome ) as Tot_MonoCharges, sum(colour_page_count) as Tot_Color, ratecard_printers.color as color, (sum(colour_page_count) * ratecard_printers.color) as Tot_ColorCharges from filtered_datafeed_details, ratecard_printers,ratecards,printers where ratecards.id = ratecard_printers.ratecard_id AND ratecards.status = 'active' AND filtered_datafeed_details.printer_id = ratecard_printers.printr_id AND ratecard_printers.printr_id=printers.id AND filtered_datafeed_details.date = '$date' AND filtered_datafeed_details.customer_id='$id->id' Group By printer_id;");

                        }


                        foreach ($invoice as $i) {
                            $sub_Tot_Base_Commit = $sub_Tot_Base_Commit + $i->Tot_Base_Commit;
                            $sub_Tot_MonoCharges = $sub_Tot_MonoCharges + $i->Tot_MonoCharges;
                            $sub_Tot_ColorCharges = $sub_Tot_ColorCharges + $i->Tot_ColorCharges;

                        }
                        $Sub_Total = $sub_Tot_ColorCharges + $sub_Tot_MonoCharges + $sub_Tot_Base_Commit;
                        $Tax = $Sub_Total * 0.08;
                        $Total_Amount = $Sub_Total + $Tax;
                        $data = [
                            'customer' => $customer,
                            'contract' => $contract,
                            'invoice' => $invoice,
                            'subtotal' => $Sub_Total,
                            'tax' => $Tax,
                            'totalamount' => $Total_Amount,
                            'date_today' => $date_today
                        ];
                        $pdf = PDF::loadView('reports.C_report', $data);
                        DB::table('report__details')->delete();
                        return $pdf->download('printers.pdf');

                    }

                    elseif ($r->type == "EPFClickOnly") {
                        $customer = Customer::where('company_name', '=', $request->companyname)->get();
                        $customer_id = DB::select("select id from customers where company_name = '$request->companyname'");
                        $date_from_text = $request->date;
                        $dt = new DateTime($date_from_text);
                        $date = $dt->format('Y-m-d');

                        $date_today = Carbon::now();
                        $date_today->toDateString();

                        $sub_Tot_Base_Commit = 0;
                        $sub_Tot_MonoCharges = 0;
                        $sub_Tot_ColorCharges = 0;

                        foreach ($customer_id as $id) {
                            $contract = Contract::where('customer_id', '=', $id->id)->get();
                            $invoice = DB::select("Select printer_id,model,COUNT(printer_id) as Num_PRNT,ratecard_printers.commitment as commitment, (COUNT(printer_id) * ratecard_printers.commitment) as Tot_Base_Commit, SUM(mono_page_count) as Tot_Mono, ratecard_printers.monochrome as monochrome, (SUM(mono_page_count) * ratecard_printers.monochrome ) as Tot_MonoCharges, sum(colour_page_count) as Tot_Color, ratecard_printers.color as color, (sum(colour_page_count) * ratecard_printers.color) as Tot_ColorCharges from filtered_datafeed_details, ratecard_printers,ratecards,printers where ratecards.id = ratecard_printers.ratecard_id AND ratecards.status = 'active' AND filtered_datafeed_details.printer_id = ratecard_printers.printr_id AND ratecard_printers.printr_id=printers.id AND filtered_datafeed_details.date = '$date' AND filtered_datafeed_details.customer_id='$id->id' Group By printer_id;");

                        }


                        foreach ($invoice as $i) {
                            $sub_Tot_Base_Commit = $sub_Tot_Base_Commit + $i->Tot_Base_Commit;
                            $sub_Tot_MonoCharges = $sub_Tot_MonoCharges + $i->Tot_MonoCharges;
                            $sub_Tot_ColorCharges = $sub_Tot_ColorCharges + $i->Tot_ColorCharges;

                        }
                        $Sub_Total = $sub_Tot_ColorCharges + $sub_Tot_MonoCharges + $sub_Tot_Base_Commit;
                        $Tax = $Sub_Total * 0.08;
                        $Total_Amount = $Sub_Total + $Tax;
                        $data = [
                            'customer' => $customer,
                            'contract' => $contract,
                            'invoice' => $invoice,
                            'subtotal' => $Sub_Total,
                            'tax' => $Tax,
                            'totalamount' => $Total_Amount,
                            'date_today' => $date_today
                        ];
                        $pdf = PDF::loadView('reports.C_report', $data);
                        DB::table('report__details')->delete();
                        return $pdf->download('printers.pdf');

                    }
                }
            }
            else{
                $pdf = PDF::loadView('reports.error', $data);
            }

        }






    }
}