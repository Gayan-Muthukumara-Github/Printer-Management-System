<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\PriceList;
use App\Models\PriceListToners;
use App\Models\Toner;
use App\Models\CompanyPrinter;
use App\Models\Contract;
use App\Models\Printer;

class PriceListController extends Controller
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
        $pricelists = PriceList::where('company_id', '=', Auth::user()->company_id)->get();
        return view('pricelists.index',[
            'pricelists' => $pricelists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::where('company_id', '=', Auth::user()->company_id)->get();
        $printers = Printer::where('company_id', '=', Auth::user()->company_id)->get();

        return view('pricelists.create',[
            'contracts' => $contracts,
            'printers' => $printers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'contract_id' => 'required',
            'contract_id' => 'required',
            'printer_model' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'toner_id' => 'required',
            'toner_cost' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('pricelists/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $price_list = PriceList::create([
                'contract_id' => $request->contract_id,
                'company_id' => Auth::user()->company_id,
                'printer_id' => $request->printer_model,
                'currency' => $request->currency,
                'price' => $request->price,
            ]);
            for ($x = 0; $x < count($request->toner_id); $x++) {
                $price_list->toner_lists()->create([
                    'toner_id' => intval($request->toner_id[$x]),
                    'price' => intval($request->toner_cost[$x])
                ]);
            }
            
            
        }
        return redirect('/pricelists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toners($printer){
        $toners = Toner::where('printer_id', '=', $printer)->get();
        return $toners;
    }
}
