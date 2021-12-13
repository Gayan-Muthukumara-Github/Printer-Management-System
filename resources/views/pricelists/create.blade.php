@extends('layouts.admin')

@section('content')

<main class="">
    <div class="m-3">
        <div class="row">
            <div class="col-sm-9 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Price List</h3>
                        <p style="font-size: 10px;">Use the following section to enter the Printer/Toner agreed purchase price for with Vendor for each contract</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br>   
                    <div class="shadow container navbottom ">
                        <form method="POST" action="/pricelists">
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
                                    <h5 class="sub-header">Price List Details</h5>
                                </div>
                                <div class="col-md-4">
                                    <label for="contract_id" class="form-label" style="font-size: 12.4px;">Contract</label>
                                    <select id="contract" name="contract_id" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        @foreach ($contracts as $contract)
                                            <option value="{{ $contract->id }}">{{ $contract->name }}</option>      
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="col-md-4">
                                    <label for="printer_model" class="form-label" style="font-size: 12.4px;">Printer Model</label>
                                    <select id="printer_model" name="printer_model" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        <option value="0">Select Option</option>
                                        @foreach ($printers as $printer)
                                            <option value="{{ $printer->id }}">{{ $printer->model }}</option>      
                                        @endforeach      
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="currency" class="form-label" style="font-size: 12.4px;">Currency</label>
                                    <select name="currency" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        <option value="usd">USD</option>      
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="designation" class="form-label" style="font-size: 12.4px;">Purchase Price</label>
                                    <input type="number" class="form-control" name="price" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                </div>
                                <div class="col-md-12">
                                    <h5>Toner Compatibility</h5>
                                    <table class="table">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody id="tbody">

                                        </tbody>
                                    </table>
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
    $("#printer_model").change(function(){
        var printer = $("#printer_model").find(":selected").val();
        $.ajax({
            url: "/pricelists/toners/"+printer,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $.each(res, function(k, v) {
                    $("#tbody").html("");
                    $("#tbody").append("<tr><td>"+v['part_number']+"</td><td>"+v['name']+"</td><td><input type='hidden' name='toner_id[]' value='"+v['id']+"'><input type='text' name='toner_cost[]' class='form-control'></td></tr>");
                });
            }
        });
    });
    
</script>
@endsection