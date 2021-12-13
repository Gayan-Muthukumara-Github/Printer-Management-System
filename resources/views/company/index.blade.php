@extends('layouts.admin')

@section('content')
 
        <!--Center Canvas -->
        <main class="">
            <div class="m-3">
            <div class="row">
                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header" >Setup Your Company</h3>
                            <p style="font-size: 10px;">Enter details of companies that you want to grant access to Manage Print Services.</p>                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                        
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
                                       <input type="text" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" value="{{ old('name') }}" name="name" required>
                                     </div>
                                     <div class="col-md-8">
                                       <label for="inputCompanyAddress" class="form-label" style="font-size: 12.4px;">Company Address</label>
                                       <input type="text" class="form-control" value="{{ old('address') }}" name="address" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCity" class="form-label" style="font-size: 12.4px;">City</label>
                                       <input type="text" value="{{ old('city') }}" name="city" list="city" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                        <datalist id="city">
                                        <option>Colombo</option>
                                        <option>Gampaha</option>
                                        <option>Kaluthara</option>
                                        <option>Galle</option>
                                        </datalist>
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCountry" class="form-label" style="font-size: 12.4px;">Country</label>
                                       <input type="text" value="{{ old('country') }}" name="country" list="country" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                        <datalist id="country">
                                        <option>Sri Lanka</option>
                                        <option>India</option>
                                        <option>Bangaladesh</option>
                                        <option>Pakistan</option>
                                        </datalist>
                                     </div>
                                     <div class="col-md-4">
                                         <label for="inputFile" class="form-label" style="font-size: 12.4px;">Company Logo (height: 35 width: 80)</label>
                                         <input class="form-control" type="file" accept="image/png, image/jpeg" name="logo" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                     </div>
                                     <div class="col-md-4">
                                         <label for="inputPhoneNumber" class="form-label" style="font-size: 12.4px;">Phone Number</label>
                                         <input type="number" class="form-control" value="{{ old('phone') }}" name="phone" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputFaxNumber" class="form-label" style="font-size: 12.4px;">Fax Number</label>
                                         <input type="number" class="form-control" value="{{ old('fax') }}" name="fax" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputMobileNumber" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                         <input type="number" class="form-control" value="{{ old('mobile') }}" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                </div>
                                <br>
                                </div>
                                <br>
                                <div class="shadow container navbottom">
                                    <div class="row g-3 pt-2 mt-2">
                             
                                        <div class="col-md-12">
                                        <h5 class="sub-header">Admin user Details</h5>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="first_name" class="form-label" style="font-size: 12.4px;">First Name</label>
                                        <input type="text" class="form-control"  value="{{ old('first_name') }}" name="first_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="last_name" class="form-label" style="font-size: 12.4px;">Last Name</label>
                                        <input type="text" class="form-control"  value="{{ old('last_name') }}" name="last_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="mobile" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                        <input type="number" class="form-control"  value="{{ old('mobile_no') }}" name="mobile_no" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label" style="font-size: 12.4px;">Email</label>
                                            <input type="email" class="form-control"  value="{{ old('email') }}" name="email" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
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
                                    </div>
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
                @if (Auth::check() && Auth::user()->system_owner == 1)
                <div class="col-sm-3" >
                    <div class="mt-3 ml-2">
                        <h6 class="sub-header">Company Details</h6>
                    </div>
                    <br>
                    <div class="container p-0">
                        <div class="row p-0">
                            <div class="radio-toolbar">
                                <div class="row">
                                    <div class="col-auto">
                                        <input type="radio" id="radioFName" name="radioLeftMenu" value="FName" checked>
                                        <label for="radioFName" style="font-size: 12.4px;">First Name and Last Name</label>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <hr class="hrdriverTop">
                        <div class="box FName">
                            <div>
                                <form action="" class="">
                                    <div class="input-group mb-3">
                                    <input id="myInput" type="text" class="form-control form-control-sm searchtext" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;"  placeholder="Search Here" onkeyup="myFunction()">
                                    </div>
                                </form>
                            </div>
                            <ul id="myUL">
                                @foreach ($companies as $company)
                                    <li>
                                        <div class="row searchrow">
                                            <div class="col-auto"><i class="bi bi-three-dots-vertical"></i></div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-auto role-name">
                                                    {{ $company->name }}
                                                    </div>
                                                    <div class="col">
                                                        @if(Auth::user()->admin == 1 && $company->deletable())
                                                            <a class="btn p-0 float-end pl-2" onclick="if (confirm('Do you want to delete')){ $('#deleterole{{$company->id}}').submit(); }"><i class="bi bi-archive-fill"></i></a>
                                                        @endif
                                                        <a href="/companies/{{ $company->id }}/edit" class="btn p-0 float-end pl-2"><i class="bi bi-pencil-fill"></i></a>
                                                    </div>  
                                                    <form action="{{ url('/companies', ['id' => $company->id]) }}" method="post" id="deleterole{{$company->id}}">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </div>      
                                            </div> 
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
           
        </main>
        <script>
function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByClassName("role-name")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
    @endsection