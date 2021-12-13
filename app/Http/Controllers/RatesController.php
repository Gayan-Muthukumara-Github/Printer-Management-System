<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RatesController extends Controller
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
        return view('rates.index', [
            'rates' => Rate::where('company_id', "=",Auth::user()->company_id)->get()
        ]);
    }


    public function store(Request $request)
    {

        // dd($request);

        $rules = array(
            'rate' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('rates')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $rate = Rate::create([
                'company_id' => Auth::user()->company_id,
                'rate' => $request->rate,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
            ]);
        }
        return redirect('/rates');
    }
}