<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Datafeed;
use App\Models\Ratecard;
use App\Models\Contract;
use App\Models\RatecardPrinter;
use App\Models\DatafeedDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $companies = Customer::where([['company_id', "=",Auth::user()->company_id], ['type', '=', 'Company']])->get();
        $groups = Customer::where([['company_id', "=",Auth::user()->company_id], ['type', '=', 'Group']])->get();
        $contracts = Contract::where('company_id', "=",Auth::user()->company_id)->get();
        return view('reports.index', [
            'companies' => $companies,
            'groups' => $groups,
            'contracts' => $contracts
        ]);
    }

    public function generate(Request $request){
        $contract = Contract::find($request->contract_id);
        $ratecard = $contract->ratecard;
        $datafeed = Datafeed::where([['group_id', "=",$contract->customer_id], ['year', '=', $request->year], ['month', '=', $request->month]])->latest()->first();
        if ($contract && $ratecard && $datafeed){
            $data = [
                'contract' => $contract,
                'ratecard' => $ratecard,
                'datafeed' => $datafeed
            ];
            // return view('reports.show', [
            //     'contract' => $contract,
            //     'ratecard' => $ratecard,
            //     'datafeed' => $datafeed
            // ]);
              
            $pdf = PDF::loadView('reports.show', $data);
        
            return $pdf->download('invoice.pdf');
        }else{
            return redirect('/reports');
            
        }
 
    }
}
