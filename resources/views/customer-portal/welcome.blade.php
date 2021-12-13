@extends('layouts.app')

@section('content')
<main class="">
    <div class="m-3">
        <div class="row">
            <div class="col mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Welcome {{$customer_portal->contact->first_name}}</h3>
                        <p style="font-size: 10px;">Please select a service</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <label for="service_type" class="form-label"  style="font-size: 12.4px;">Select a service from the list</label><br />
                                <select name="service_type" id="service_type" class="form-control">
                                    <option value="Toner Request">Toner Request</option>
                                    <option value="Printer Drum">Printer Drum</option>
                                    <option value="Service">Service</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <br />
                                <button type="submit" class="btn btn-primary" style="height: 30px;font-size: 12px;" id="verify">Select</button>
                            </div>
                            
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <form method="POST" action="/customer-portal/{{$customer_portal->id}}/request" class="row">
                                @csrf
                                <div class="col-md-8">
                                
                                    <input type="hidden" value ="Toner Request" name="request_type">
                                    <input type="hidden" value ="{{$customer_portal->contact->customer_id}}" name="customer_id">
                                    <input type="hidden" value ="{{$customer_portal->customer_id}}" name="contact_id">
                                    
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Printer Serial</th>
                                                <th>Printer Model</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer_portal->contact->customer->company_printers as $company_printer)
                                                <tr>
                                                    <th>
                                                        <input required type="radio" name="printer_id" data-id="{{$company_printer->printer->id}}" value="{{$company_printer->printer->id}}">
                                                    </th>
                                                    <td>{{$company_printer->serial_number}}</td>
                                                    <td>{{$company_printer->printer->model}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-4">
                                    <table id="toner-details" class="table table-striped table-bordered" style="width:100%">
                                        
                                    </table>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-secondary" style="height: 30px;font-size: 12px;" id="verify">Send Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $('input[type=radio][name=printer_id]').change(function() {
        printer_id = $(this).data('id');
        $.ajax({
            url: "/toners/"+printer_id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#toner-details").html("<thead><tr><th colspan='3'>Select the Toner you want</th></tr></thead><tbody id='tbody'></tbody>");
                $.each(res, function(k, v) {
                    $("#tbody").append("<tr><td><input required type='checkbox' name='request_type_id[]' value='"+v['id']+"'></td><td>"+v['name']+"</td></tr>");
                });
            }
        });
    });
</script>
@endsection
