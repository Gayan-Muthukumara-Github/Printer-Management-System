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
                        
                        <form method="POST" action="{{ route('companies.update', $company->id)}}" class="row g-3" style="padding-bottom: 20px;">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
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
                                       <input value="{{$company->name}}" type="text" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="name" required>
                                     </div>
                                     <div class="col-md-8">
                                       <label for="inputCompanyAddress" class="form-label" style="font-size: 12.4px;">Company Address</label>
                                       <input value="{{$company->address}} " type="text" class="form-control" name="address" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCity" class="form-label" style="font-size: 12.4px;">City</label>
                                       <input value="{{$company->city}}" type="text" name="city" list="city" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                        <datalist id="city">
                                        <option>Colombo</option>
                                        <option>Gampaha</option>
                                        <option>Kaluthara</option>
                                        <option>Galle</option>
                                        </datalist>
                                     </div>
                                     <div class="col-md-4">
                                       <label for="inputCountry" class="form-label" style="font-size: 12.4px;">Country</label>
                                       <input value="{{$company->country}}" type="text" name="country" list="country" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
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
                                         <input value="{{$company->phone}}" type="number" class="form-control" name="phone" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputFaxNumber" class="form-label" style="font-size: 12.4px;">Fax Number</label>
                                         <input value="{{$company->fax}}" type="number" class="form-control" name="fax" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       <div class="col-md-4">
                                         <label for="inputMobileNumber" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                         <input  value="{{$company->mobile}}" type="number" class="form-control" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                       </div>
                                       
                                      </div> 
                                      <br>
                                <div class="row g-3 pt-2 mt-2">
                             
                                        <div class="col-md-12">
                                        <h5 class="sub-header">Admin user Details</h5>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="first_name" class="form-label" style="font-size: 12.4px;">First Name</label>
                                        <input type="text" class="form-control" value="{{$admin->first_name }}" name="first_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="last_name" class="form-label" style="font-size: 12.4px;">Last Name</label>
                                        <input type="text" class="form-control" value="{{$admin->last_name }}" name="last_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="mobile" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                        <input type="number" class="form-control" value="{{$admin->mobile_no }}" name="mobile_no" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label" style="font-size: 12.4px;">Email</label>
                                            <input type="email" class="form-control" value="{{$admin->email }}" name="email" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    <br>
                                    <br>                                   
                                </div>
                            </form>
                            <br>
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