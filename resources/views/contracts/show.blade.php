@extends('layouts.admin')

@section('content')

<main class="">
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Register New Contract</h3>
                        <p style="font-size: 10px;">Add new contracts to start adding new printer and track revenue generated.</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br>   
                    <div class="shadow container navbottom ">

                        <div class="row g-3">
                            <div class="col-md-4">
                                <h5 class="sub-header">Contract Details</h5>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="float-end">
                                <a href="/contracts/{{$contract->id}}/edit" class="btn btn-primary" style="height: 29px;font-size: 12.4px;"><i class="bi bi-pencil p-1"></i>Edit</a>&nbsp;
                                <a href="/contracts/{{$contract->id}}/rate-crad" class="btn btn-dark" style="height: 29px;font-size: 12.4px;"><i class="bi bi-cash-stack p-1"></i>Rate Card</a>&nbsp;
                                <a href="/contracts/{{$contract->id}}/printers" class="btn btn-primary" style="height: 29px;font-size: 12.4px;"><i class="bi bi-printer-fill p-1" ></i>New Printer</a>
                                </div>   
                            </div>
                            
                            <div class="col-md-4">
                                <label for="contract_id" class="form-label"  style="font-size: 12.4px;">Contract ID</label>
                                <input type="text" disabled class="form-control" value="{{$contract->contract_id}}" readonly id="contract_id" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="contract_id"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label"  style="font-size: 12.4px;">Contract Name</label>
                                <input type="text" disabled value="{{$contract->name}}" class="form-control" id="name" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="name"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="customer_id" class="form-label"  style="font-size: 12.4px;">Customer</label>
                                <input type="text" disabled class="form-control" value="{{$contract->customer->company_name}}" id="master_contract" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="master_contract"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="contract_type" class="form-label"  style="font-size: 12.4px;">Contract Type</label>
                                <select disabled id="contract_type" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;" name="contract_type"  required>
                                    <option @if($contract->contract_type == 1) selected @endif value="1">Contract Type 1</option>
                                    <option @if($contract->contract_type == 2) selected @endif value="2">Contract Type 2</option>
                                    <option @if($contract->contract_type == 3) selected @endif value="3">Contract Type 3</option>
                                    <option @if($contract->contract_type == 4) selected @endif value="4">Contract Type 4</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="master_contract" class="form-label"  style="font-size: 12.4px;">Master Contract</label>
                                <input type="text" disabled class="form-control" value="{{$contract->master_contract}}" id="master_contract" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="master_contract"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="monthly_commitment" class="form-label"  style="font-size: 12.4px;">Monthly Commitment</label>
                                <input type="number" disabled class="form-control" value="{{$contract->monthly_commitment}}" id="monthly_commitment" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="monthly_commitment"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="contract_signed_at" class="form-label"  style="font-size: 12.4px;">Contract Signed Date</label>
                                <input type="date" disabled class="form-control" value="{{$contract->contract_signed_at}}" id="contract_signed_at" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="contract_signed_at"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="exchange_rate" class="form-label"  style="font-size: 12.4px;">Exchange Rate (1 USD)</label>
                                <input type="number" disabled class="form-control"  value="{{$contract->exchange_rate}}" id="exchange_rate" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="exchange_rate"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="rate_card_id" class="form-label"  style="font-size: 12.4px;">Rate Card</label>
                                <input type="text" disabled readonly class="form-control" value="{{$contract->rate_card_id}}" id="rate_card_id" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="rate_card_id"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="service_level" class="form-label"  style="font-size: 12.4px;">Service Levels</label>
                                <input type="text" disabled class="form-control" value="{{$contract->service_level}}" id="service_level" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="service_level"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="contract_contact_person" class="form-label"  style="font-size: 12.4px;">Contract Contact Person</label>
                                <input type="text" disabled class="form-control" value="{{$contract->contract_contact_person}}" id="contract_contact_person" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="contract_contact_person"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="upload" class="form-label"  style="font-size: 12.4px;">Upload</label>
                                <p><a class="form-label" href="/storage/{{$contract->upload}}">Download</a></p>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_1" class="form-label"  style="font-size: 12.4px;">Salient Point 1</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_1}}" id="salient_point_1" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_1"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_2" class="form-label"  style="font-size: 12.4px;">Salient Point 2</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_2}}" id="salient_point_2" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_2"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_3" class="form-label"  style="font-size: 12.4px;">Salient Point 3</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_3}}" id="salient_point_3" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_3"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_4" class="form-label"  style="font-size: 12.4px;">Salient Point 4</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_4}}" id="salient_point_4" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_4"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_5" class="form-label"  style="font-size: 12.4px;">Salient Point 5</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_5}}" id="salient_point_5" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_5"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_6" class="form-label"  style="font-size: 12.4px;">Salient Point 6</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_6}}" id="salient_point_6" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_6"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_7" class="form-label" style="font-size: 12.4px;">Salient Point 7</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_7}}" id="salient_point_7" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_7"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_8" class="form-label"  style="font-size: 12.4px;">Salient Point 8</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_8}}" id="salient_point_8" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_8"  required>
                            </div>
                            <div class="col-md-4">
                                <label for="salient_point_9" class="form-label"  style="font-size: 12.4px;">Salient Point 9</label>
                                <input type="text" disabled class="form-control" value="{{$contract->salient_point_9}}" id="salient_point_9" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="salient_point_9"  required>
                            </div>
                        </div>
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
    $(document).ready(function(){
        $(".contractID").hide();
        $(".company").show();
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox =$("."+ inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
</script>
@endsection