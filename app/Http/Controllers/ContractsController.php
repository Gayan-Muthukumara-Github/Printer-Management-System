<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyPrinter;
use App\Models\Printer;
use App\Models\Ratecard;
use App\Models\RatecardPrinter;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::where('company_id', "=", Auth::user()->company_id)->get();
        return view('contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.create', [
            'customers' => Customer::where('company_id', "=", Auth::user()->company_id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last_contract = Contract::where('company_id', "=", Auth::user()->company_id)->orderBy('created_at', 'DESC')->first();

        if ($last_contract)
            $contract_id = '' . str_pad($last_contract->id + 1, 5, "0", STR_PAD_LEFT);
        else {
            $contract_id = "00001";
        }
        $rate_card = Ratecard::where([['company_id', "=", Auth::user()->company_id], ['status', "=", 'active']])->orderBy('created_at', 'desc')->first();
        $rate_card_id = null;
        if ($rate_card) {
            $rate_card_id = $rate_card->id;
        }

        $rules = array(
            "name" => 'required',
            "customer_id" => 'required',
            "contract_type" => 'required',
            "master_contract" => 'required',
            "monthly_commitment" => 'required',
            "contract_signed_at" => 'required',
            "exchange_rate" => 'required',
            "service_level" => 'required',
            "contract_contact_person" => 'required',
            "salient_point_1" => 'required',
            "salient_point_2" => 'required',
            "salient_point_3" => 'required',
            "salient_point_4" => 'required',
            "salient_point_5" => 'required',
            "salient_point_6" => 'required',
            "salient_point_7" => 'required',
            "salient_point_8" => 'required',
            "salient_point_9" => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('contracts/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->file()) {
                $fileName = time() . '_' . $request->upload->getClientOriginalName();
                $filePath = $request->file('upload')->storeAs('uploads', $fileName, 'public');
            }


            $contract = Contract::create([
                'company_id' => Auth::user()->company_id,
                'contract_id' => $contract_id,
                'rate_card_id' => $rate_card_id,
                'upload' => $filePath,
                'name' => $request->name,
                'customer_id' => $request->customer_id,
                'contract_type' => $request->contract_type,
                'master_contract' => $request->master_contract,
                'monthly_commitment' => $request->monthly_commitment,
                'contract_signed_at' => $request->contract_signed_at,
                'exchange_rate' => $request->exchange_rate,
                'rate_card_id' => $rate_card_id,
                'service_level' => $request->service_level,
                'contract_contact_person' => $request->contract_contact_person,
                'salient_point_1' => $request->salient_point_1,
                'salient_point_2' => $request->salient_point_2,
                'salient_point_3' => $request->salient_point_3,
                'salient_point_4' => $request->salient_point_4,
                'salient_point_5' => $request->salient_point_5,
                'salient_point_6' => $request->salient_point_6,
                'salient_point_7' => $request->salient_point_7,
                'salient_point_8' => $request->salient_point_8,
                'salient_point_9' => $request->salient_point_9,

            ]);
        }
        return redirect('/contracts/' . $contract->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        return view('contracts.show', [
            'contract' => $contract
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::find($id);
        if ($contract && Auth::user()->company_id == $contract->company_id) {
            return view('contracts.edit', [
                'contract' => $contract,
                'customers' => Customer::where('company_id', "=", Auth::user()->company_id)->get()
            ]);
        } else {
            return redirect('/contracts');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);

        $contract = Contract::find($id);
        if ($contract && Auth::user()->company_id == intval($contract->company_id)) {
            $rules = array(
                "name" => 'required',
                "customer_id" => 'required',
                "contract_type" => 'required',
                "master_contract" => 'required',
                "monthly_commitment" => 'required',
                "contract_signed_at" => 'required',
                "exchange_rate" => 'required',
                "rate_card_id" => 'required',
                "service_level" => 'required',
                "contract_contact_person" => 'required',
                "salient_point_1" => 'required',
                "salient_point_2" => 'required',
                "salient_point_3" => 'required',
                "salient_point_4" => 'required',
                "salient_point_5" => 'required',
                "salient_point_6" => 'required',
                "salient_point_7" => 'required',
                "salient_point_8" => 'required',
                "salient_point_9" => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('contracts/' . $id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($request->file()) {
                    $fileName = time() . '_' . $request->upload->getClientOriginalName();
                    $filePath = $request->file('upload')->storeAs('uploads', $fileName, 'public');
                    $contract->upload = $filePath;
                }
                $contract->name = $request->name;
                $contract->customer_id = $request->customer_id;
                $contract->contract_type = $request->contract_type;
                $contract->master_contract = $request->master_contract;
                $contract->monthly_commitment = $request->monthly_commitment;
                $contract->contract_signed_at = $request->contract_signed_at;
                $contract->exchange_rate = $request->exchange_rate;
                $contract->rate_card_id = $request->rate_card_id;
                $contract->service_level = $request->service_level;
                $contract->contract_contact_person = $request->contract_contact_person;
                $contract->salient_point_1 = $request->salient_point_1;
                $contract->salient_point_2 = $request->salient_point_2;
                $contract->salient_point_3 = $request->salient_point_3;
                $contract->salient_point_4 = $request->salient_point_4;
                $contract->salient_point_5 = $request->salient_point_5;
                $contract->salient_point_6 = $request->salient_point_6;
                $contract->salient_point_7 = $request->salient_point_7;
                $contract->salient_point_8 = $request->salient_point_8;
                $contract->salient_point_9 = $request->salient_point_9;
                $contract->save();

                if ($request->exists('save')) {
                    return redirect('/contracts');
                }
                if ($request->exists('rate')) {
                    return redirect('/contracts/' . $id . '/rate-crad');
                }
                if ($request->exists('print')) {
                    return redirect('/contracts/' . $id . '/printers');
                }
            }
        } else {
            return redirect('/contracts');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function contract_ratecard($id, $ratecard_id)
    {
        $contract =


        $ratecard = Ratecard::find($ratecard_id);
        if ($contract && $ratecard) {
            return view('contracts.contract_ratecard', [
                'contract' => $contract,
                'ratecard' => $ratecard
            ]);
        }
    }

    public function ratecrad($id)
    {
        $contract = Contract::find($id);
        if ($contract && Auth::user()->company_id == $contract->company_id) {
            // $printer_ids = CompanyPrinter::distinct('printer_id')->pluck('printer_id')->toArray();
            // $printers = Printer::whereIn('id', $printer_ids)->get();
            $printers = CompanyPrinter::select('printer_model')->groupBy('printer_model')->get();
            return view('contracts.rate_card', [
                'contract' => $contract,
                'printers' => $printers,
            ]);
        }
    }

    public function printers($id)
    {
        $contract = Contract::find($id);
        if ($contract && Auth::user()->company_id == $contract->company_id) {
            $printers = CompanyPrinter::where('contract_id', "=", $contract->id)->get();
            $num_models = $printers->groupBy('printer_id')->count();
            $con_method = $printers->groupBy('con_method')->count();
            $num_department = $printers->groupBy('branch')->count();
            $dup_printers = $printers->groupBy('serial_number');
            $duplicates = 0;
            foreach ($dup_printers as $key => $dup_printer) {
                if ($dup_printer->count() > 1) {
                    $duplicates += 1;
                }
            }

            return view('contracts.printers', [
                'contract' => $contract,
                'printers' => $printers,
                'num_models' => $num_models,
                'num_department' => $num_department,
                'duplicates' => $duplicates,
                'con_method' => $con_method
            ]);
        }
    }

    public function bulk_printers(Request $request, $id)
    {
        $contract = Contract::find($id);
        //if ($contract && Auth::user()->company_id == $contract->company_id){
        $csvFile = fopen(request()->file('file'), "r");

        fgetcsv($csvFile);
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            $printer = Printer::where([['company_id', "=", Auth::user()->company_id], ['model', "=", $row[1]]])->first();
            //if($printer){
            $cprinter = CompanyPrinter::create([
                "contract_id" => $contract->id,
                "company_id" => Auth::user()->company_id,
                "customer_id" => $contract->customer_id,
                "serial_number" => $row[0],
                "printer_model" => $row[1],
                "status" => $row[3],
                "dip_cost" => "N/A",
                "branch" => $row[5],
                "department" => $row[7],
                "con_method" => $row[8],
                "installation_at" => $row[9],
                "start_page_count" => $row[10],
                "start_page_count_color" => $row[11],
                "duty_cycle" => "N/A",
                "printer_id" => "N/A",
                "printer_checked" => 0,
                "company_checked" =>0,
                "company" => $row[6]
            ]);
            //}
        }
        return redirect('/contracts/' . $id . '/printers');
        //}else{
        //return redirect('/contracts');
        //}
    }

    public function check_printers(Request $request, $id)
    {
        $contract = Contract::find($id);
        $company_printers = Printer::get();
        foreach ($company_printers as $cp) {
            $temp = DB::table('company_printers')
                ->select('company_printers.id', 'printers.monthly_duty_cycle')
                ->join('printers', 'company_printers.printer_model', '=', 'printers.model')
                ->where('printer_model', '=', $cp->model)
                ->get();

            foreach ($temp as $t) {
                $affected = DB::table('company_printers')
                    ->where('id','=', $t->id)
                    ->update(['duty_cycle' => $t->monthly_duty_cycle,'printer_id' => $cp->id,'printer_checked' => 1]);
            }


        }

        $customer = Customer::get();
        foreach ($customer as $cus) {
            $temp1 = DB::table('company_printers')
                ->select('company_printers.id')
                ->join('customers', 'company_printers.branch', '=', 'customers.company_name')
                ->where('branch', '=', $cus->company_name)
                ->get();

            foreach ($temp1 as $t) {
                $affected = DB::table('company_printers')
                    ->where('id','=', $t->id)
                    ->update(['company_checked' => 1]);
            }


        }
        return redirect('/contracts/' . $id . '/printers');

    }

    public function add_ratecrad(Request $request, $id)
    {
        $contract = Contract::find($id);
        if ($contract && Auth::user()->company_id == $contract->company_id) {

            if ($request->type == "BaseClick") {
                $rules = array(
                    "input_base_click_printr_id" => 'present|array',
                    "input_base_click_commitment" => 'present|array',
                    "input_base_click_monochrome" => 'present|array',
                    "input_base_click_color" => 'present|array',
                );
                $customMessages = [
                    'input_base_click_color.present' => 'The color field is required.',
                    'input_base_click_commitment.present' => 'The commitmentr field is required.',
                    'input_base_click_monochrome.present' => 'The monochrome field is required.',
                ];
            } elseif ($request->type == "ClickOnlyAvgTotPMode") {
                $rules = array(
                    "input_click_only_avarage_base_printer_id" => 'present|array',
//                    "input_click_only_avarage_base_commitment1" => 'present|array',
                    "input_click_only_avarage_monichrome" => 'present|array',
                    "input_click_only_avarage_color" => 'present|array',
                );
                if ($request->apply_exchange == "on") {
                    $rules["exchange_diff"] = 'required';
                    $rules["monochrome"] = 'required';
                    $rules["print_volume"] = 'required';
                }
                $customMessages = [
                    'input_click_only_avarage_color.present' => 'The color field is required.',
                    'input_click_only_avarage_monichrome.present' => 'The monochrome field is required.',
                    'input_click_only_avarage_base_commitment1.present' => 'The commitment field is required.',
                    'input_click_only_avarage_base_commitment.present' => 'The commitment field is required.',
                ];

            } elseif ($request->type == "OnlyEveryP") {
                $rules = array(
                    "input_click_only_every_printer" => 'present|array',
                    "input_click_only_every_base_commitment" => 'present|array',
                    "input_click_only_every_base_commitment_1" => 'present|array',
                    "input_click_only_every_base_monochrome" => 'present|array',
                    "input_click_only_every_base_color" => 'present|array',
                );
                if ($request->apply_exchange == "on") {
                    $rules["exchange_diff"] = 'required';
                    $rules["monochrome"] = 'required';
                    $rules["print_volume"] = 'required';
                }
                $customMessages = [
                    'input_click_only_every_base_color.present' => 'The color field is required.',
                    'input_click_only_every_base_monochrome.present' => 'The monochrome field is required.',
                    'input_click_only_every_base_commitment_1.present' => 'The commitment field is required.',
                    'input_click_only_every_base_commitment.present' => 'The commitment field is required.',
                ];

            } elseif ($request->type == "EPFClickOnly") {
                $rules = array(
                    "input_epf_printer" => 'present|array',
                    "input_epf_base_commitment" => 'present|array',
                    "input_epf_monochrome" => 'present|array',
                    "input_epf_color" => 'present|array',
                );
                if ($request->apply_exchange == "on") {
                    $rules["exchange_diff"] = 'required';
                    $rules["monochrome"] = 'required';
                    $rules["print_volume"] = 'required';
                }
                $customMessages = [
                    'input_epf_color.present' => 'The color field is required.',
                    'input_epf_monochrome.present' => 'The monochrome field is required.',
                    'input_epf_base_commitment.present' => 'The commitment field is required.',
                ];

            }


            $validator = Validator::make($request->all(), $rules, $customMessages);
            // $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('contracts/' . $id . '/rate-crad')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $apply_exchange = 0;
                $group_wise = 0;
                if ($request->apply_exchange == "on") {
                    $apply_exchange = 1;
                }
                if ($request->group_wise == "on") {
                    $group_wise = 1;
                }

                $ratecards = DB::table('ratecards')->where('company_id', '=', Auth::user()->company_id)->update(array('status' => "inactive"));

                $ratecard = Ratecard::create([
                    "company_id" => Auth::user()->company_id,
                    "customer_id" => $contract->customer_id,
                    "type" => $request->type,
                    "apply_exchange" => $apply_exchange,
                    "exchange_diff" => $request->exchange_diff,
                    "monochrome" => $request->monochrome,
                    "print_volume" => $request->print_volume,
                    "group_wise" => $group_wise,
                    'user_id' => Auth::user()->id,
                    'contract_id' => $contract->id
                ]);

                $contract->rate_card_id = $ratecard->id;
                $contract->save();


                if ($request->type == "BaseClick") {
                    for ($x = 0; $x < count($request->input_base_click_printr_id); $x++) {
                        $printer = Printer::where([['company_id', "=", Auth::user()->company_id], ['model', "=", $request->input_base_click_printr_id[$x]]])->first();
                        RatecardPrinter::create([
                            "ratecard_id" => $ratecard->id,
                            'printr_id' => $printer->id,
                            'commitment' => $request->input_base_click_commitment[$x],
                            'monochrome' => $request->input_base_click_monochrome[$x],
                            'color' => $request->input_base_click_color[$x],
                        ]);
                    }
                } elseif ($request->type == "ClickOnlyAvgTotPMode") {
                    for ($x = 0; $x < count($request->input_click_only_avarage_base_printer_id); $x++) {
                        $printer = Printer::where([['company_id', "=", Auth::user()->company_id], ['model', "=", $request->input_click_only_avarage_base_printer_id[$x]]])->first();
                        RatecardPrinter::create([
                            "ratecard_id" => $ratecard->id,
                            'printr_id' => $printer->id,
                            'commitment' => $request->input_click_only_avarage_base_commitment[$x],
//                            'commitment_1' => $request->input_click_only_avarage_base_commitment1[$x],
                            'monochrome' => $request->input_click_only_avarage_monichrome[$x],
                            'color' => $request->input_click_only_avarage_color[$x],
                        ]);
                    }
                } elseif ($request->type == "OnlyEveryP") {
                    for ($x = 0; $x < count($request->input_click_only_every_printer); $x++) {
                        $printer = Printer::where([['company_id', "=", Auth::user()->company_id], ['model', "=", $request->input_click_only_every_printer[$x]]])->first();
                        RatecardPrinter::create([
                            "ratecard_id" => $ratecard->id,
                            'printr_id' => $printer->id,
                            'commitment' => $request->input_click_only_every_base_commitment[$x],
                            'commitment_1' => $request->input_click_only_every_base_commitment_1[$x],
                            'monochrome' => $request->input_click_only_every_base_monochrome[$x],
                            'color' => $request->input_click_only_every_base_color[$x],
                        ]);
                    }
                } elseif ($request->type == "EPFClickOnly") {
                    for ($x = 0; $x < count($request->input_epf_printer); $x++) {
                        $printer = Printer::where([['company_id', "=", Auth::user()->company_id], ['model', "=", $request->input_epf_printer[$x]]])->first();
                        RatecardPrinter::create([
                            "ratecard_id" => $ratecard->id,
                            'printr_id' => $printer->id,
                            'commitment' => $request->input_epf_base_commitment[$x],
                            'monochrome' => $request->input_epf_monochrome[$x],
                            'color' => $request->input_epf_color[$x],
                        ]);
                    }
                }

            }

            return redirect('/contracts/' . $id . '/rate-crad');
        } else {
            return redirect('/contracts');
        }
    }
}
