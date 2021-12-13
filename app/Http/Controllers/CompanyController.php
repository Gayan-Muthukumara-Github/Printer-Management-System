<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
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
        if (Auth::user()->system_owner == 1){
            return view('company.index', [
                'companies' => Company::all()
            ]);
        }else{
            return redirect('/companies/'.Auth::user()->company_id);
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'unique:users',
            'email' => 'email',
            'email' => 'required',
            'password' => 'required',
            'password' => 'confirmed',
            'name' => 'required',
            'name' => 'unique:companies',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'logo' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'mobile_no' => 'required',
        );

        $user = User::where('email', '=', $request->email)->first();
        if($user){
            return redirect('companies')
                        ->withErrors("user email already in use")
                        ->withInput();
        }
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('companies')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            if($request->file()) {
                $fileName = time().'_'.$request->logo->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
            }

            $company = Company::create([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'logo' => $filePath,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'mobile' => $request->mobile,
            ]);

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'company_id' => $company->id,
                'admin' => 1,
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $admin_user = $company->users->where('admin', '=', "1")->first();
        if($company){
            return view('company.edit', [
                'company' => $company,
                'admin' => $admin_user
            ]); 
        }
        return redirect('/companies');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'name' => 'required',
            'name' => 'unique:companies'.($id ? ',id,'.$id : ''),
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('companies/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $company = Company::find($id);
            $filePath = $company->logo;
            if($request->file()) {
                $fileName = time().'_'.$request->logo->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
            }
            $company->name = $request->name;
            $company->address = $request->address;
            $company->city = $request->city;
            $company->country = $request->country;
            $company->phone = $request->phone;
            $company->fax = $request->fax;
            $company->mobile = $request->mobile;
            $company->logo = $filePath;
            $company->save();

            $admin_user = $company->users->where('admin', '=', "1")->first();
            $admin_user->first_name = $request->first_name;
            $admin_user->last_name = $request->last_name;
            $admin_user->email = $request->email;
            $admin_user->mobile_no = $request->mobile_no;
            $admin_user->save();
        }
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company){
            $company->delete();
        }
        return redirect('/companies');
    }
}
