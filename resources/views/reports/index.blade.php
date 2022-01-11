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
                                <div class="col-md-4">
                                    <label for="contractcustomers">Contarct Customers</label>
                                    <select id="companyname" name="companyname" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;" required>
                                        @foreach ($ccustomers as $cc)
                                            <option value="{{$cc->company_name}}">{{$cc->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="select_groups">Date</label>
                                    <input required class="form-control" type="date" name="date" id="date" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                </div>

                                <div class="col-md-2">
                                    <label for="select_contract">Contract</label>
                                    <input type="email" class="form-control"  value="Scola" name="email" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" readonly>
{{--                                    <select id="select_contract" name="contract_id" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;">--}}
{{--                                        @foreach ($contracts as $contracts)--}}
{{--                                            <option value="{{$contracts->id}}">{{$contracts->contract_id}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
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







