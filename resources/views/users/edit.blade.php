@extends('layouts.admin')

@section('content')
 
<main class="">
            <div class="m-3">
            <div class="row">
                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header">Setup your Employees</h3>
                            <p style="font-size: 10px;">User the form below to edit your employees' details and their system roles.</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                        <form method="POST" action="{{ route('users.update', $user->id)}}" class="row g-3">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                   <h5 class="sub-header">Employee Details</h5>
                                  </div>
                                  <div class="col-md-4">
                                        <label for="first_name" class="form-label" style="font-size: 12.4px;">First Name</label>
                                        <input value="{{$user->first_name}}" type="text" class="form-control" name="first_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="last_name" class="form-label" style="font-size: 12.4px;">Last Name</label>
                                        <input value="{{$user->last_name}}" type="text" class="form-control" name="last_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="designation" class="form-label" style="font-size: 12.4px;">Designation</label>
                                            <input value="{{$user->designation}}" type="text" class="form-control" name="designation" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role" class="form-label" style="font-size: 12.4px;">User Role</label>
                                            <select name="role" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                                @foreach ($roles as $role)
                                                    @if($user->role_id == $role->id)
                                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                                    @else
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>      
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="mobile" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                        <input value="{{$user->mobile_no}}" type="number" class="form-control" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department" class="form-label" style="font-size: 12.4px;">Department</label>
                                            <input value="{{$user->department}}" type="text" class="form-control" name="department" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label" style="font-size: 12.4px;">Email</label>
                                            <input value="{{$user->email}}" type="email" class="form-control" name="email" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                  
                              </form>
                            </div>
                            
                            
                              <br>
                              <br>
                              <br>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
           
        </main>
    @endsection