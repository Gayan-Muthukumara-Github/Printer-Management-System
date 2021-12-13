<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
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
        return view('customers.index', [
            'customers' => Customer::where('company_id', "=",Auth::user()->company_id)->get()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Customer::where('company_id', "=",Auth::user()->company_id)->where('type', "=", "Group")->get();
        return view('customers.create', [
            'groups' => $groups
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
            'company_name' => 'required',
            'company_address' => 'required',
            'city' => 'required',
            'type' => 'required',
            'group_entity' => 'required',
            'phone_number' => 'required',
            'fax_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'land_line' => 'required',
            'email' => 'required',
            'department' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('customers/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $customer = Customer::create([
                'company_id' => Auth::user()->company_id,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'city' => $request->city,
                'type' => $request->type,
                'group_entity' => $request->group_entity,
                'phone_number' => $request->phone_number,
                'fax_number' => $request->fax_number,
                'svat' => $request->svat,
                'vat' => $request->vat,
            ]);

            for ($x = 0; $x < count($request->first_name); $x++) {
                Contact::create([
                    'first_name' => $request->first_name[$x],
                    'last_name' => $request->last_name[$x],
                    'mobile' => $request->mobile[$x],
                    'land_line' => $request->land_line[$x],
                    'email' => $request->email[$x],
                    'department' => $request->department[$x],
                    'customer_id' => $customer->id,
                ]);
            }

            
        }
        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customers' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
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
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
