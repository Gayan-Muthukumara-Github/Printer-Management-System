@extends('layouts.admin')

@section('content')

<!--Center Canvas -->
    <main class="">
        <div class="m-3">
            <div class="row">
                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header">Set up User Roles</h3>
                            <p style="font-size: 10px;">Setup the user roles so that you can group users and grant access privileges to each user in the company.</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                            @if(Auth::user()->havePermission('createuserroles'))
                                <form method="POST" action="/roles" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <h5 class="sub-header">Role Details</h5>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="col-md-4" style="font-size: 12.4px;">
                                            <label for="inputUserRoleName" class="form-label">User Role Name</label>
                                            <input type="text" class="form-control" name="inputUserRoleName" required>
                                            <br>
                                            <row style="font-size: 12.4px;">
                                                <div class="col">
                                                    <div class="form-control">
                                                        <div class="role-alert" id ="alertVCD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckViewCompanyDetails').checked= false">&times;</span> 
                                                            View Company Details
                                                        </div>
                                                        <div class="role-alert" id ="alertACD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckAddCompanyDetails').checked= false">&times;</span> 
                                                            Add Company Details
                                                        </div>
                                                        <div class="role-alert" id ="alertECD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditCompanyDetails').checked= false">&times;</span> 
                                                            Edit Company Details
                                                        </div>
                                                        <div class="role-alert" id ="alertCUR" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckCreateUserRoles').checked= false">&times;</span> 
                                                            Create User Roles
                                                        </div>
                                                        <div class="role-alert" id ="alertEUR" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditUserRoles').checked= false">&times;</span> 
                                                            Edit User Roles
                                                        </div>
                                                        <div class="role-alert" id ="alertDUR" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckDeleteUserRoles').checked= false">&times;</span> 
                                                            Delete User Roles
                                                        </div>
                                                        <div class="role-alert" id ="alertVUD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckViewUserDetails').checked= false">&times;</span> 
                                                            View User Details
                                                        </div>
                                                        <div class="role-alert" id ="alertAUD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckAddUserDetails').checked= false">&times;</span> 
                                                            Add User Details
                                                        </div>
                                                        <div class="role-alert" id ="alertEUD" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditUserDetails').checked= false">&times;</span> 
                                                            Edit User Details
                                                        </div>
                                                        <div class="role-alert" id ="alertAMM" style="font-size: 12.4px;">
                                                            <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckAllMajorModules').checked= false">&times;</span> 
                                                            Access To All Major Modules
                                                        </div>
                                                    </div>     
                                                </div>
                                            </row>
                                        </div>
                                        <div class="col-md-8" style="font-size: 12.4px;">
                                            <label for="inputUserRoleName" class="form-label">Solution Features</label>
                                            <div class="form-control">
                                                <div class="form-check" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="setup" name="flexCheckSetup" id="flexCheckSetup" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('flexCheckViewCompanyDetails').checked= true;
                                                    document.getElementById('alertVCD').style.display='block';
                                                    document.getElementById('flexCheckAddCompanyDetails').checked= true;
                                                    document.getElementById('alertACD').style.display='block';
                                                    document.getElementById('flexCheckEditCompanyDetails').checked= true;
                                                    document.getElementById('alertECD').style.display='block';
                                                    document.getElementById('flexCheckCreateUserRoles').checked= true;
                                                    document.getElementById('alertCUR').style.display='block';
                                                    document.getElementById('flexCheckEditUserRoles').checked= true;
                                                    document.getElementById('alertEUR').style.display='block';
                                                    document.getElementById('flexCheckDeleteUserRoles').checked= true;
                                                    document.getElementById('alertDUR').style.display='block';
                                                    document.getElementById('flexCheckViewUserDetails').checked= true;
                                                    document.getElementById('alertVUD').style.display='block';
                                                    document.getElementById('flexCheckAddUserDetails').checked= true;
                                                    document.getElementById('alertAUD').style.display='block';
                                                    document.getElementById('flexCheckEditUserDetails').checked= true;
                                                    document.getElementById('alertEUD').style.display='block';
                                                    document.getElementById('flexCheckAllMajorModules').checked= true;
                                                    document.getElementById('alertAMM').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('flexCheckViewCompanyDetails').checked= false;
                                                    document.getElementById('alertVCD').style.display = 'none';
                                                    document.getElementById('flexCheckAddCompanyDetails').checked= false;
                                                    document.getElementById('alertACD').style.display = 'none';
                                                    document.getElementById('flexCheckEditCompanyDetails').checked= false;
                                                    document.getElementById('alertECD').style.display = 'none';
                                                    document.getElementById('flexCheckCreateUserRoles').checked= false;
                                                    document.getElementById('alertCUR').style.display = 'none';
                                                    document.getElementById('flexCheckEditUserRoles').checked= false;
                                                    document.getElementById('alertEUR').style.display = 'none';
                                                    document.getElementById('flexCheckDeleteUserRoles').checked= false;
                                                    document.getElementById('alertDUR').style.display = 'none';
                                                    document.getElementById('flexCheckViewUserDetails').checked= false;
                                                    document.getElementById('alertVUD').style.display = 'none';
                                                    document.getElementById('flexCheckAddUserDetails').checked= false;
                                                    document.getElementById('alertAUD').style.display = 'none';
                                                    document.getElementById('flexCheckEditUserDetails').checked= false;
                                                    document.getElementById('alertEUD').style.display = 'none';
                                                    document.getElementById('flexCheckAllMajorModules').checked= false;
                                                    document.getElementById('alertAMM').style.display='node';
                                                    };">
                                                    <label class="form-check-label" for="flexCheckSetup" style="font-size: 12.4px;">
                                                        Setup
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="viewcompanydetails" name="permissions[]" id="flexCheckViewCompanyDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertVCD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertVCD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckViewCompanyDetails" style="font-size: 12.4px;">
                                                        View Company Details
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="addcompanydetails" name="permissions[]" id="flexCheckAddCompanyDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertACD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertACD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckAddCompanyDetails" style="font-size: 12.4px;">
                                                        Add Company Details
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="editcompanydetails" name="permissions[]" id="flexCheckEditCompanyDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertECD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertECD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckEditCompanyDetails" style="font-size: 12.4px;">
                                                        Edit Company Details
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="createuserroles" name="permissions[]" id="flexCheckCreateUserRoles" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertCUR').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertCUR').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckCreateUserRoles" style="font-size: 12.4px;">
                                                        Create User Roles
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="edituserroles" name="permissions[]" id="flexCheckEditUserRoles" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertEUR').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertEUR').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckEditUserRoles" style="font-size: 12.4px;">
                                                        Edit User Roles
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="deleteuserroles" name="permissions[]" id="flexCheckDeleteUserRoles" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertDUR').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertDUR').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckDeleteUserRoles" style="font-size: 12.4px;">
                                                        Delete User Roles
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="viewuserdetails" name="permissions[]" id="flexCheckViewUserDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertVUD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertVUD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckViewUserDetails" style="font-size: 12.4px;">
                                                        View User Details
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input" type="checkbox" value="adduserdetails" name="permissions[]" id="flexCheckAddUserDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertAUD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertAUD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckAddUserDetails" style="font-size: 12.4px;">
                                                        Add User Details
                                                    </label>
                                                </div>
                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input"  type="checkbox" value="edituserdetails" name="permissions[]" id="flexCheckEditUserDetails" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertEUD').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertEUD').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckEditUserDetails" style="font-size: 12.4px;">
                                                        Edit User Details
                                                    </label>
                                                </div>

                                                <div class="form-check px-5" style="font-size: 12.4px;">
                                                    <input class="form-check-input"  type="checkbox" value="allmajormodules" name="permissions[]" id="flexCheckAllMajorModules" onclick="if (this.checked==true)
                                                    {
                                                    document.getElementById('alertAMM').style.display='block';
                                                    }
                                                    else
                                                    {
                                                    document.getElementById('alertAMM').style.display = 'none';
                                                    document.getElementById('flexCheckSetup').checked= false;
                                                    };">
                                                    <label class="form-check-label" for="flexCheckAllMajorModules" style="font-size: 12.4px;">
                                                        Access To All Major Modules
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="sub-header">Role Details</h5>
                                    <div class="no-data"></div>
                                </div>
                            @endif
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                    <br>
                </div>


                <div class="col-sm-3" >
                <div class="mt-3 ml-2">
                    <h6 class=""  style="font-size: 16px;font-weight: 600;">User Roles</h6>
                </div>
                <br>
                <div class="container p-0">
                    <hr class="hrdriverTop">
                    <div class="box LName">
                        <div>
<form action="" class="">
<div class="input-group mb-3">
<input id="myInput" type="text" class="form-control form-control-sm searchtext" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;"  placeholder="Search Here" onkeyup="myFunction()">
</div>
</form>
</div>


<ul id="myUL">
@foreach ($roles as $role)
<li>
<div class="row searchrow">
<div class="col-auto"><i class="bi bi-three-dots-vertical"></i></div>
<div class="col-10">
<div class="row">
<div class="col-auto role-name">
{{ $role->name }}
</div>
<div class="col">
@if(Auth::user()->havePermission('deleteuserroles'))
<a class="btn p-0 float-end pl-2" onclick="if (confirm('Do you want to delete')){ $('#deleterole{{$role->id}}').submit(); }"><i class="bi bi-archive-fill"></i></a>
@endif
@if(Auth::user()->havePermission('edituserroles'))
<a href="/roles/{{$role->id}}/edit" class="btn p-0 float-end pl-2"><i class="bi bi-pencil-fill"></i></a>
@endif
</div>
<form action="{{ url('/roles', ['id' => $role->id]) }}" method="post" id="deleterole{{$role->id}}">
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