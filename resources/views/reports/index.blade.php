@extends('layouts.admin')

@section('content')
    <style>
        .hidden{
            display: none;
        }
    </style>
    <main class="">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="row g-3"> 

                    <div class="row">
                        <form class="row g-3" method="GET" action="/reports/generate">
                            @csrf
                            <div class="col-md-12">
                                <h5 class="sub-header">Reports</h5>
                                <br>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="reporttypes">Report Types</label>
                                    <select id="reporttypes" name="reporttypes" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;" required>
                                        <option value="group_wise_commitment_based" selected>Group wise invoicing - Commitment based on the averaging total prints on respective printer model</option>
                                        <!-- <option value="company_wise_commitment_based">Company wise invoicing - Commitment based on the averaging total prints on respective printer model</option>
                                        <option value="group_wise_minimum_commitment">Group wise invoicing - minimum commitment for every printer</option>
                                        <option value="company_wise_minimum_commitment">Company wise invoicing - minimum commitment for every printer</option>
                                        <option value="group_wise_total_minimum_commitment">Group wise invoicing - Total minimum commitment for entire printer fleet</option>
                                        <option value="company_wise_total_minimum_commitment">Company wise invoicing - Total minimum commitment for entire printer fleet</option> -->
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label for="select_groups">Year</label>
                                    <select id="select_groups" name="year" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label for="select_company">Month</label>
                                    <select id="select_company" name="month" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="select_contract">Contract</label>
                                    <select id="select_contract" name="contract_id" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;">
                                        @foreach ($contracts as $contracts)
                                            <option value="{{$contracts->id}}">{{$contracts->contract_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row align-items-end">
                                        <!-- <div class="col-md-3">
                                            <label class="form-label" style="font-size: 12.4px;">Select From Date</label>
                                            <input required type="date" id="SelectFromDate" class="form-control" name="SelectFromDate" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" style="font-size: 12.4px;">Select to Date</label>
                                            <input required type="date" id="SelecttoDate" class="form-control" name="SelecttoDate" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div> -->
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary" style="font-size: 12.4px;">Generate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // $("#reporttypes").change(function(){
        //     $(this).find("option:selected").each(function(){
        //         var optionValue = $(this).attr("value");
        //         if (optionValue =="group_wise_commitment_based" || optionValue =="group_wise_minimum_commitment" || optionValue =="group_wise_total_minimum_commitment"){
        //             if($("#select_groups").hasClass('hidden') ){
        //                 $("#select_groups").removeClass('hidden');
        //             } 
        //             if(!$("#select_company").hasClass('hidden')){
        //                 $("#select_company").addClass('hidden');
        //             }
        //         }

        //         if (optionValue =="company_wise_commitment_based" || optionValue =="company_wise_minimum_commitment" || optionValue =="company_wise_total_minimum_commitment"){
        //             if($("#select_company").hasClass('hidden') ){
        //                 $("#select_company").removeClass('hidden');
        //             } 
        //             if(!$("#select_groups").hasClass('hidden')){
        //                 $("#select_groups").addClass('hidden');
        //             }
        //         }
        //     });
        // });
    </script>
@endsection







