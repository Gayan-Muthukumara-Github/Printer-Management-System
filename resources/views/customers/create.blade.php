@extends('layouts.admin')

@section('content')
<main class="">
    <div class="row">
        <div class="col-sm-12 mainbackground">
            <div class="mt-3 ml-2">
                <div>
                    <h3 class="main-header">Add New Customer Details</h3>
                    <p style="font-size: 10px;">Use the form below to add new Customer Details</p>
                    <div class="pb-2">
                        <hr>
                    </div>
                </div>   
                <br>   
                <div class="shadow container navbottom ">
                    <form method="POST" action="/customers" enctype="multipart/form-data">
                        @csrf
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
                        <div class="row g-3"> 
                            <div class="col-md-8">
                                <h5 class="sub-header">Customer Details</h5>
                            </div>
                            <div class="col-md-4">
                                <!-- <button type="submit" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"><i class="bi bi-folder-plus p-1"></i>Bulk Upload</button> -->
                            </div>
                            <div class="col-md-4">
                                <label for="company_name" class="form-label" style="font-size: 12.4px;">Company Name</label>
                                <input type="text" class="form-control" value="{{ old('company_name') }}" name="company_name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-8">
                                <label for="company_address" class="form-label" style="font-size: 12.4px;">Company Address</label>
                                <input type="text" class="form-control" value="{{ old('company_address') }}" name="company_address" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                                <div class="col-md-4">
                                <label for="city" class="form-label" style="font-size: 12.4px;">City</label>
                                <input type="text" name="city" value="{{ old('city') }}" list="city" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                <datalist id="city">
                                    <option>Colombo</option>
                                    <option>Gampaha</option>
                                    <option>Kaluthara</option>
                                    <option>Galle</option>
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="type" class="form-label" style="font-size: 12.4px;">Company Type</label>
                                <input type="text" value="{{ old('companytype') }}" name="type" list="companytype" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                <datalist id="companytype">
                                    <option>Group</option>
                                    <option>Company</option>
                                    <option>Branch</option>
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="group_entity" class="form-label" style="font-size: 12.4px;">Group Entity</label>
                                <input type="text" value="{{ old('group_entity') }}" name="group_entity" list="groupentity" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                <datalist id="groupentity">
                                    <option>N/A</option>
                                    @foreach($groups as $group)
                                        <option>{{$group->company_name}}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="phone_number" class="form-label" style="font-size: 12.4px;">Phone Number</label>
                                <input type="number" class="form-control" value="{{ old('phone_number') }}" name="phone_number" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-4">
                                <label for="fax_number" class="form-label" style="font-size: 12.4px;">Fax Number</label>
                                <input type="number" class="form-control" value="{{ old('fax_number') }}" name="fax_number" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-2">
                                <label for="vat" class="form-label" style="font-size: 12.4px;">VAT</label>
                                <input type="text" class="form-control" value="{{ old('vat') }}" name="vat" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                            </div>
                            <div class="col-md-2">
                                <label for="svat" class="form-label" style="font-size: 12.4px;">SVAT</label>
                                <input type="text" class="form-control" value="{{ old('svat') }}" name="svat" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="shadow container navbottom ">
                            <div class="col-md-12 g-3 pt-3 mt-2">
                                <h5 class="sub-header">Contact Person</h5>
                            </div>
                            <br>
                            <div class="col-md-12">       
                                <a onclick="add_row();" for="formusd" name="formcontactsave" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"><i class="bi bi-plus p-1"></i>New Contact</a>
                                <br><br>
                                <table class="table table-bordered" style="font-size: 11px;" name="data_table" id="data_table">
                                    <thead>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">Landline Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department &nbsp;&nbsp;<button type="button" class="btn p-0 add" value="Add Row" style="font-size: 11px;"><i class="bi bi-plus-circle-fill"></i></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="first_name[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="last_name[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="mobile[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="land_line[]">
                                            </td>
                                            <td>
                                                <input type="email" class="form-control" name="email[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="department[]">
                                            </td>
                                            <td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</main>
<script>

    function delete_row($this){
        $this.closest('tr').remove();
    }

    function add_row(){
        $("#data_table").append('<tr><td><input type="text" class="form-control" name="first_name[]"></td><td><input type="text" class="form-control" name="last_name[]"></td><td><input type="text" class="form-control" name="mobile[]"></td><td><input type="text" class="form-control" name="land_line[]"></td><td><input type="email" class="form-control" name="email[]"></td><td><input type="text" class="form-control" name="department[]"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></tr>');
    }
</script>

@endsection