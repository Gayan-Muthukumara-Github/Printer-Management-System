@extends('layouts.admin')

@section('content')
 
<main class="">
            <div class="m-3">
            <div class="row">
                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header">Setup your Employees</h3>
                            <p style="font-size: 10px;">User the form below to enter your employees' details and their system roles.</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                            <form method="POST" action="/users">
                                @csrf
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
                                        <input type="text" class="form-control" name="first_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="last_name" class="form-label" style="font-size: 12.4px;">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="designation" class="form-label" style="font-size: 12.4px;">Designation</label>
                                            <input type="text" class="form-control" name="designation" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role" class="form-label" style="font-size: 12.4px;">User Role</label>
                                            <select name="role" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>      
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="mobile" class="form-label" style="font-size: 12.4px;">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department" class="form-label" style="font-size: 12.4px;">Department</label>
                                            <input type="text" class="form-control" name="department" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
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
                                  
                              </form>
                            </div>
                            
                            
                              <br>
                              <br>
                              <br>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="col-sm-3" >
                    <div class="mt-3 ml-2">
                        <h6 class="sub-header">User Details</h6>
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
                                @foreach ($users as $user)
                                    <li>
                                        <div class="row searchrow">
                                            <div class="col-auto"><i class="bi bi-three-dots-vertical"></i></div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-auto role-name">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                    </div>
                                                    <div class="col">
                                                        @if(Auth::user()->admin == 1)
                                                            <a class="btn p-0 float-end pl-2" onclick="if (confirm('Do you want to delete')){ $('#deleterole{{$user->id}}').submit(); }"><i class="bi bi-archive-fill"></i></a>
                                                        @endif

                                                        @if(Auth::user()->havePermission('edituserdetails') || Auth::user()->id == $user->id)
                                                            <a href="/users/{{$user->id}}/edit" class="btn p-0 float-end pl-2"><i class="bi bi-pencil-fill"></i></a>
                                                        @endif
                                                    </div>
                                                    <form action="{{ url('/users', ['id' => $user->id]) }}" method="post" id="deleterole{{$user->id}}">
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