<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
        return view('roles.index', [
            'roles' => Role::where('company_id', "=",Auth::user()->company_id)->get()
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

        // dd($request->permissions);
        $rules = array(
            'inputUserRoleName' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('roles')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $role = Role::create([
                'name' => $request->inputUserRoleName,
                'company_id' => Auth::user()->company_id
            ]);
            foreach ($request->permissions as $permission) {
                $role->permissions()->create([
                    'permission' => $permission
                ]);
            }
            
        }
        return redirect('/roles');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $role = Role::find($id);
        if($role && Auth::user()->company_id == $role->company_id){
            return view('roles.edit', [
                'role' => $role
            ]);
        }else{
            return redirect('/roles');
        }
        
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
        // dd($request);
        $rules = array(
            'inputUserRoleName' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('roles')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $role = Role::find($id);
            $role->name = $request->inputUserRoleName;
            $role->save();
            $role->permissions()->delete();
            foreach ($request->permissions as $permission) {
                $role->permissions()->create([
                    'permission' => $permission
                ]);
            }
            
        }
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role){
            $role->delete();
        }
        return redirect('/roles');
    }
}
