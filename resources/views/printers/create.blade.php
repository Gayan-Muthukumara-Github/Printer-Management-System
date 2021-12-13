@extends('layouts.admin')

@section('content')
    <main class="">
        <form method="POST" action="/printers" enctype="multipart/form-data">
            @csrf
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
            <div class="row">
                <div class="col-sm-12 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header">Add New Printer Details</h3>
                            <p style="font-size: 10px;">Use the form below to add new printer details</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                            <div class="row g-3"> 
                                <div class="col-md-12">
                                    <h5 class="sub-header">Printer Details</h5>
                                </div>
                                <br>
                                <br>
                            <div class="col-md-3">
                                <label for="brand" class="form-label" style="font-size: 12.4px;">Brand</label>
                                <input type="text" value="{{ old('brand') }}" name="brand" list="brand" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                <datalist id="brand">
                                    <option>HP</option>
                                </datalist>
                            </div>
                            <div class="col-md-3">
                                <label for="port_number" class="form-label" style="font-size: 12.4px;">Part Number</label>
                                <input type="text" class="form-control" value="{{ old('port_number') }}" name="port_number" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-3">
                                <label for="model" class="form-label" style="font-size: 12.4px;">Model</label>
                                <input type="text" class="form-control" value="{{ old('model') }}" name="model" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-3">
                                <label for="image" class="form-label" style="font-size: 12.4px;">Image</label>
                                <input class="form-control" type="file" name="image" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                            </div>
                            <div class="col-md-3">
                                <label for="function" class="form-label" style="font-size: 12.4px;">Function</label>
                                <input multiple type="text" value="{{ old('function') }}" name="function" list="function" class="form-control" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required/>
                                <datalist id="function">
                                    <option >Print</option>
                                    <option>Copy</option>
                                    <option>Fax</option>
                                    <option>Scan</option>
                                </datalist>
                            </div>
                            <div class="col-md-3">
                                <label for="monthly_duty_cycle" class="form-label" style="font-size: 12.4px;">Monthly Duty Cycle</label>
                                <input type="number" class="form-control" value="{{ old('monthly_duty_cycle') }}" name="monthly_duty_cycle" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-3">
                                <label for="recommended_monthly_page_volume" class="form-label" style="font-size: 12.4px;">Recommended Monthly Page Volume</label>
                                <input type="text" class="form-control" value="{{ old('recommended_monthly_page_volume') }}" name="recommended_monthly_page_volume" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                            <div class="col-md-3">
                                <label for="cost" class="form-label" style="font-size: 12.4px;">Cost</label>
                                <input type="number" class="form-control" value="{{ old('pcost') }}" name="pcost" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="shadow container navbottom ">
                        <div class="col-md-12 g-3 pt-3 mt-2">
                            <h5 class="sub-header">Toner Details</h5>
                        </div>
                        <br>
                    <div class="col-md-12">                                    
                    <table class="table table-bordered table-responsive" style="font-size: 11px;" name="data_table" id="data_table">
                        <thead>
                            <th scope="col">Part Number</th>
                            <th scope="col">Toner Name</th>
                            <th scope="col">Duty Cycle</th>
                            <th scope="col">Cost</th>
                            <th><button type="button" class="btn p-0 add" value="Add Row" onclick="add_row();" style="font-size: 11px;"><i class="bi bi-plus-circle-fill"></i></th>
                        </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="part_number[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="duty_cycle[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="cost[]">
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
        </form>    
    </main>
    <script>

        function delete_row($this)
        {
            $this.closest('tr').remove();
        }

        function add_row()
        {
            $("#data_table").append('<tr><td><input type="text" class="form-control" name="part_number[]"></td><td><input type="text" class="form-control" name="name[]"></p></td><td><input type="text" class="form-control" name="duty_cycle[]"></td><td><input type="text" class="form-control" name="cost[]"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></tr>');
        }
    </script>

@endsection