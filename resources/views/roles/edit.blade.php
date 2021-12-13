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

                            <form method="POST" action="{{ route('roles.update', $role->id)}}" class="row g-3">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                            <div class="row g-3">
                            
                                <div class="col-md-12">
                                   
                                   <h5 class="sub-header">Company Details</h5>
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
                                    <input type="text" class="form-control" name="inputUserRoleName" required value="{{$role->name}}">
                                    <br>
                                    <row style="font-size: 12.4px;">
                                        <div class="col">
                                            <div class="form-control">
                                                <div class="role-alert" id ="viewcompanydetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckViewCompanyDetails').checked= false">&times;</span> 
                                                    View Company Details
                                                </div>
                                                <div class="role-alert" id ="addcompanydetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckAddCompanyDetails').checked= false">&times;</span> 
                                                    Add Company Details
                                                </div>
                                                <div class="role-alert" id ="editcompanydetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditCompanyDetails').checked= false">&times;</span> 
                                                    Edit Company Details
                                                </div>
                                                <div class="role-alert" id ="createuserroles" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckCreateUserRoles').checked= false">&times;</span> 
                                                    Create User Roles
                                                </div>
                                                <div class="role-alert" id ="edituserroles" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditUserRoles').checked= false">&times;</span> 
                                                    Edit User Roles
                                                </div>
                                                <div class="role-alert" id ="deleteuserroles" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckDeleteUserRoles').checked= false">&times;</span> 
                                                    Delete User Roles
                                                </div>
                                                <div class="role-alert" id ="viewuserdetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckViewUserDetails').checked= false">&times;</span> 
                                                    View User Details
                                                </div>
                                                <div class="role-alert" id ="adduserdetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckAddUserDetails').checked= false">&times;</span> 
                                                    Add User Details
                                                </div>
                                                <div class="role-alert" id ="edituserdetails" style="font-size: 12.4px;">
                                                    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('flexCheckEditUserDetails').checked= false">&times;</span> 
                                                    Edit User Details
                                                </div>
                                                <div class="role-alert" id ="allmajormodules" style="font-size: 12.4px;">
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
                                                                                                                                                        document.getElementById('viewcompanydetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckAddCompanyDetails').checked= true;
                                                                                                                                                        document.getElementById('addcompanydetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckEditCompanyDetails').checked= true;
                                                                                                                                                        document.getElementById('editcompanydetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckCreateUserRoles').checked= true;
                                                                                                                                                        document.getElementById('createuserroles').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckEditUserRoles').checked= true;
                                                                                                                                                        document.getElementById('edituserroles').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckDeleteUserRoles').checked= true;
                                                                                                                                                        document.getElementById('deleteuserroles').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckViewUserDetails').checked= true;
                                                                                                                                                        document.getElementById('viewuserdetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckAddUserDetails').checked= true;
                                                                                                                                                        document.getElementById('adduserdetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckEditUserDetails').checked= true;
                                                                                                                                                        document.getElementById('edituserdetails').style.display='block';
                                                                                                                                                        document.getElementById('flexCheckAllMajorModules').checked= true;
                                                                                                                                                        document.getElementById('alertAMM').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('flexCheckViewCompanyDetails').checked= false;
                                                                                                                                                        document.getElementById('viewcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckAddCompanyDetails').checked= false;
                                                                                                                                                        document.getElementById('addcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckEditCompanyDetails').checked= false;
                                                                                                                                                        document.getElementById('editcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckCreateUserRoles').checked= false;
                                                                                                                                                        document.getElementById('createuserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckEditUserRoles').checked= false;
                                                                                                                                                        document.getElementById('edituserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckDeleteUserRoles').checked= false;
                                                                                                                                                        document.getElementById('deleteuserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckViewUserDetails').checked= false;
                                                                                                                                                        document.getElementById('viewuserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckAddUserDetails').checked= false;
                                                                                                                                                        document.getElementById('adduserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckEditUserDetails').checked= false;
                                                                                                                                                        document.getElementById('edituserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckAllMajorModules').checked= false;
                                                                                                                                                        document.getElementById('allmajormodules').style.display='node';
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckSetup" style="font-size: 12.4px;">
                                                Setup
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="viewcompanydetails" name="permissions[]" id="flexCheckViewCompanyDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('viewcompanydetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('viewcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckViewCompanyDetails" style="font-size: 12.4px;">
                                                View Company Details
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="addcompanydetails" name="permissions[]" id="flexCheckAddCompanyDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('addcompanydetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('addcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckAddCompanyDetails" style="font-size: 12.4px;">
                                                Add Company Details
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="editcompanydetails" name="permissions[]" id="flexCheckEditCompanyDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('editcompanydetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('editcompanydetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckEditCompanyDetails" style="font-size: 12.4px;">
                                                Edit Company Details
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="createuserroles" name="permissions[]" id="flexCheckCreateUserRoles" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('createuserroles').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('createuserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckCreateUserRoles" style="font-size: 12.4px;">
                                                Create User Roles
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="edituserroles" name="permissions[]" id="flexCheckEditUserRoles" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('edituserroles').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('edituserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckEditUserRoles" style="font-size: 12.4px;">
                                                Edit User Roles
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="deleteuserroles" name="permissions[]" id="flexCheckDeleteUserRoles" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('deleteuserroles').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('deleteuserroles').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckDeleteUserRoles" style="font-size: 12.4px;">
                                                Delete User Roles
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="viewuserdetails" name="permissions[]" id="flexCheckViewUserDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('viewuserdetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('viewuserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckViewUserDetails" style="font-size: 12.4px;">
                                                View User Details
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="adduserdetails" name="permissions[]" id="flexCheckAddUserDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('adduserdetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('adduserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckAddUserDetails" style="font-size: 12.4px;">
                                                Add User Details
                                            </label>
                                          </div>
                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input"  type="checkbox" value="edituserdetails" name="permissions[]" id="flexCheckEditUserDetails" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('edituserdetails').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('edituserdetails').style.display = 'none';
                                                                                                                                                        document.getElementById('flexCheckSetup').checked= false;
                                                                                                                                                    };">
                                            <label class="form-check-label" for="flexCheckEditUserDetails" style="font-size: 12.4px;">
                                                Edit User Details
                                            </label>
                                          </div>

                                          <div class="form-check px-5" style="font-size: 12.4px;">
                                            <input class="form-check-input"  type="checkbox" value="allmajormodules" name="permissions[]" id="flexCheckAllMajorModules" onclick="if (this.checked==true)
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('allmajormodules').style.display='block';
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                        document.getElementById('allmajormodules').style.display = 'none';
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

        <script>
            $(document).ready(function() {
                <?php foreach($role->permissions as $permission) { ?>
                    element = $("input[value='{{$permission->permission}}']");
                    element.click();
                    $('#{{$permission->permission}}').css("display", "block");
                <?php } ?>
            });
        </script>
        
    @endsection