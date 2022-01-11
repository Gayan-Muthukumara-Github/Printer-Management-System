@extends('layouts.admin')

@section('content')
 
        <!--Center Canvas -->
        <main class="">
            <div class="m-3">
            <div class="row">
                <div class="mb-1"><a href="index.php">Dashboard</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Company</strong></div>

                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header" >Setup Your Company</h3>
                            <p style="font-size: 10px;">Enter details of companies that you want to grant access to Manage Print Services.</p>                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom">
                        
                        <form method="POST" action="/companies" enctype="multipart/form-data">
                            @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="sub-header">Company Details</h5>
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
                                     <div class="col-md-4">
                                       <label for="inputCompanyName" class="form-label" style="font-size: 12.4px;">Company Name</label>
                                       <input disabled value="{{$company->name}}" type="text" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="name" required>
                                     </div>
                                     <div class="col-md-8">
                                       <label for="inputCompanyAddress" class="form-label" style="font-size: 12.4px;">Company Address</label>
                                       <input disabled value="{{$company->address}}" type="text" class="form-control" name="address" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCity" class="form-label" style="font-size: 12.4px;">City</label>
                                       <input disabled value="{{$company->city}}" type="text" name="city" list="city" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                        
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCountry" class="form-label" style="font-size: 12.4px;">Country</label>
                                       <input disabled value="{{$company->country}}" type="text" name="country" list="country" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                        
                                     </div>
                                     <div class="col-md-4">
                                         <label for="inputFile" class="form-label" style="font-size: 12.4px;">Company Logo (height: 35 width: 80)</label>
                                         <img src="/storage/{{$company->logo}}" alt="" width="100px">
                                     </div>
                                     <div class="col-md-4">
                                         <label for="inputPhoneNumber" class="form-label" style="font-size: 12.4px;">Phone Number</label>
                                         <input disabled value="{{$company->phone}}" type="number" class="form-control" name="phone" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputFaxNumber" class="form-label" style="font-size: 12.4px;">Fax Number</label>
                                         <input disabled value="{{$company->fax}}"  type="number" class="form-control" name="fax" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputMobileNumber" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                         <input disabled value="{{$company->mobile}}"  type="number" class="form-control" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                </div>
                                <br>
                                </div>
                                <br>
                                <!-- <div class="shadow container navbottom">
                                    <div class="row g-3 pt-2 mt-2">
                             
                                        <div class="col-md-12">
                                        <h5 class="sub-header">Admin user Details</h5>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="first_name" class="form-label" style="font-size: 12.4px;">First Name</label>
                                        <input type="text" class="form-control" name="first_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="last_name" class="form-label" style="font-size: 12.4px;">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="mobile" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label" style="font-size: 12.4px;">Email</label>
                                            <input type="email" class="form-control" name="email" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password" class="form-label" style="font-size: 12.4px;">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-confirm" class="form-label" style="font-size: 12.4px;">Retype Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div> -->
                            </form>
                              <br>
                            <br>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
           
        </main>
        
    @endsection