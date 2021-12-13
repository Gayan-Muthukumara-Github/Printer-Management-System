<?php

namespace App\Http\Controllers;
use App\Models\Printer;
use App\Models\Toner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PrinterCategolsController extends Controller
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
        return view('printers.index', [
            'printers' => Printer::where('company_id', "=",Auth::user()->company_id)->get()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('printers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $rules = array(
            'brand' => 'required',
            'model' => 'required',
            'image' => 'required',
            'function' => 'required',
            'pcost' => 'required',
            'port_number' => 'required',
            'port_number' => 'unique:printers',
            'name' => 'required',
            'duty_cycle' => 'required',
            'cost' => 'required'
        );
        $messages = [
            'port_number.required' => 'The Part Number field is required.',
            'port_number.unique' => 'The Part Number has already been taken.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/printers/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            if($request->file()) {
                $fileName = time().'_'.$request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            }

            $printer = Printer::create([
                'company_id' => Auth::user()->company_id,
                'brand' => $request->brand,
                'port_number' => $request->port_number,
                'model' => $request->model,
                'image' => $filePath,
                'function' => $request->function,
                'monthly_duty_cycle' => $request->monthly_duty_cycle,
                'recommended_monthly_page_volum' => $request->recommended_monthly_page_volume,
                'cost' => $request->pcost
            ]);

            for ($x = 0; $x < count($request->part_number); $x++) {
                Toner::create([
                    'part_number' => $request->part_number[$x],
                    'name' => $request->name[$x],
                    'duty_cycle' => intval($request->duty_cycle[$x]),
                    'cost' => intval($request->cost[$x]),
                    'printer_id' => $printer->id,
                ]);
            }

            
        }
        return redirect('/printers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Printer $printer)
    {
        return view('printer.show', [
            'printer' => $printer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Printer $printer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Printer $printer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $printer = Printer::find($id);
        if($printer){
            $printer->delete();
        }
        return redirect('/printers');
    }


}
