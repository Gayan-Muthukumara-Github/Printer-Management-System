<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        return view('users.index', [
            'users' => User::where([['company_id', "=",Auth::user()->company_id], ['system_owner', "=",0]])->get(),
            'roles' => Role::where('company_id', "=",Auth::user()->company_id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'role' => 'required',
            'designation' => 'required',
            'department' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile,
                'company_id' => Auth::user()->company_id,
                'admin' => 0,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'designation' => $request->designation,
                'department' => $request->department
            ]);
        }
        return redirect('/users');
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
        $user = User::find($id);
        if($user && Auth::user()->company_id == $user->company_id){
            return view('users.edit', [
                'user' => $user,
                'roles' => Role::where('company_id', "=",Auth::user()->company_id)->get()
            ]);
        }else{
            return redirect('/users');
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
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'unique:users'.($id ? ',id,'.$id : ''),
            'email' => 'email',
            'email' => 'required',
            'role' => 'required',
            'designation' => 'required',
            'department' => 'required',
        );
      
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('users/'.$id.'/edit/')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile;
            $user->company_id = Auth::user()->company_id;
            $user->admin = 0;
            $user->role_id = $request->role;
            $user->designation = $request->designation;
            $user->department = $request->department;
            $user->save();
        }
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return redirect('/users');
    }
}
