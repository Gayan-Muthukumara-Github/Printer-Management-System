@extends('layouts.admin')
@section('content')

<main class="">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col-sm-12 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="">Rate Card Contract ID {{$contract->contract_id}}</h3>
                        <p>Add new contracts to start adding new printer and track revenue generated.</p>
                        <div class="pb-2">
                            <hr>
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
                    </div>   
                    <br>   
                    <div class="shadow container navbottom ">
                        <form class="row g-3 align-items-end" method="POST" action="/contracts/{{$contract->id}}/add_ratecrad">
                            {{ csrf_field() }}
                            <p></p>
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="fw-bold"><label for="inputRateCardType" class="form-label">Rate Card Type</label></h6>
                                    <select id="inputRateCardType" name="type" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;">
                                        <option selected value="BaseClick">Base + Click</option>
                                        <option value="ClickOnlyAvgTotPMode">Click Only (Avg Total / Printer Model)</option>
                                        <option value="OnlyEveryP">Click Only (On every printer)</option>
                                        <option value="EPFClickOnly">Click Only (Entire Printer Fleet)</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="topselectionelemnt">
                                        <div class="row">
                                            <h6 class="fw-bold"><label for="inputApplyExchangeRateRule" class="form-label">Apply Exchange Rate Rule</label></h6>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input py-2 px-4" type="checkbox" id="applyexchangeraterule" name="apply_exchange" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="exchange_diff" id="inputExchangeDiff" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                    </div>
                                                        <div class="col-md-3">
                                                        <select name="monochrome" id="inputMonochrome" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                            <option value="monochrome">Monochrome</option>
                                                            <option value="colour">Colour</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="print_volume" class="form-control" id="inputPrintVolume" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <br>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="topselectionelemnt2">
                                        <div class="row">
                                            <h6 class="fw-bold"><label for="inputApplyExchangeRateRule" class="form-label">Billing Rule</label></h6>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Group Wise</label>
                                                    </div> 
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input py-2 px-4" type="checkbox" id="billingrule" name="group_wise">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Company Wise</label>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="squre BaseClick">
                                <div class="shadow container navbottom pt-2 mt-2">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-3">
                                            <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Printer Model</label>
                                            <select name="base_click_printr_id" type="text" class="form-select" id="ClickPrinterModel" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                @foreach ($printers as $printer)
                                                    <option value="{{ $printer->id }}">{{ $printer->printer_model }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="inputBaseCommitment" class="form-label"  style="font-size: 12.4px;">Base Commitment</label>
                                            <input type="text" class="form-control" name="input_base_click_commitment" id="ClickinputBaseCommitment" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputMonochrome" class="form-label"  style="font-size: 12.4px;">Monochrome</label>
                                                    <input type="text" class="form-control" name="input_base_click_monochrome" id="ClickinputMonochrome" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                </div>
                                                <div class="col">
                                                    <label for="inputColor" class="form-label"  style="font-size: 12.4px;">Color</label>
                                                    <input type="text" class="form-control" name="input_base_click_color" id="ClickinputColor" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button  type="button" class="btn btn-primary float-end" style="height: 28px;font-size: 12.4px;" onclick="base_click_add_row()">Add</button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <table class="table table-bordered" style="font-size: 11px;" name="data_table" id="data_table">
                                                <thead>
                                                    <th scope="col" style="width:30%;">Printer Model</th>
                                                    <th scope="col" style="width:10%;">Base commitment</th>
                                                    <th scope="col" style="width:5%;">Monochrome</th>
                                                    <th scope="col" style="width:5%;">Color</th>
                                                    <th scope="col" style="width:5%;"></th>
                                                </thead>
                                                <tbody id="base_click_add_row_tbody">
                                                    
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="squre ClickOnlyAvgTotPMode">
                                <div class="shadow container navbottom pt-2 mt-2">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-3">
                                            <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Printer Model</label>
                                            <select type="text" class="form-select" name="click_only_avarage_printer" id="inputPrinterModel" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                @foreach ($printers as $printer)
                                                    <option value="{{ $printer->id }}">{{ $printer->printer_model }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="inputBaseCommitment" class="form-label"  style="font-size: 12.4px;">Monthly Commitment</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="click_only_avarage_base_commitment" id="ClickOnlyAvarageBaseCommitment" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                    </div>
{{--                                                    <div class="col">--}}
{{--                                                        <input type="text" class="form-control" name="click_only_avarage_base_commitment_1" id="ClickOnlyAvarageBaseCommitment1" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="inputMonochrome" class="form-label"  style="font-size: 12.4px;">Monochrome</label>
                                                        <input type="text" class="form-control" name="click_only_avarage_monichrome" id="ClickOnlyAvarageMonochrome" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                    </div>
                                                    <div class="col">
                                                        <label for="inputColor" class="form-label"  style="font-size: 12.4px;">Color</label>
                                                        <input type="text" class="form-control" name="click_only_avarage_color" id="ClickOnlyAvarageColor" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button  type="button" class="btn btn-primary float-end" style="height: 28px;font-size: 12.4px;" onclick="ClickOnlyAvgTotPMode()">Add</button>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-9">                                    
                                                <table class="table table-bordered" style="font-size: 11px;" name="data_table" id="data_table">
                                                    <thead>
                                                        <th scope="col" style="width:30%;">Printer Model</th>
                                                        <th scope="col" style="width:10%;">Commitment</th>
                                                        <th scope="col" style="width:5%;">Monochrome</th>
                                                        <th scope="col" style="width:5%;">Color</th>
                                                        <th scope="col" style="width:5%;"></th>
                                                    </thead>
                                                    <tbody id="click_only_avarage_add_row_tbody">
                                                        
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    </div>

                        <div class="squre OnlyEveryP">
                            <div class="shadow container navbottom pt-2 mt-2">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Printer Model</label>
                                        <select type="text" class="form-select" name="click_only_every_printer" id="inputClickOnlyPrinterModel" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            @foreach ($printers as $printer)
                                                <option value="{{ $printer->id }}">{{ $printer->printer_model }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="inputBaseCommitment" class="form-label"  style="font-size: 12.4px;">Monthly Commitment</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="click_only_every_printerbase_commitment" id="inputClickOnlyCommitment" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="click_only_every_printerbase_commitment_1" id="inputClickOnlyCommitment_1" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="inputMonochrome" class="form-label"  style="font-size: 12.4px;">Monochrome</label>
                                                <input type="text" class="form-control" name="click_only_every_printerbase_monochrome" id="inputClickOnlyMonochrome" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                            <div class="col">
                                                <label for="inputColor" class="form-label"  style="font-size: 12.4px;">Color</label>
                                                <input type="text" class="form-control" name="click_only_every_printerbase_color" id="inputClickOnlyColor" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button  type="button" class="btn btn-primary float-end" style="height: 28px;font-size: 12.4px;" onclick="click_olny_add_row();">Add</button>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-9">                                    
                                        <table class="table table-bordered" style="font-size: 11px;" name="data_table" id="data_table">
                                            <thead>
                                                <th scope="col" style="width:30%;">Printer Model</th>
                                                <th scope="col" style="width:10%;">Min</th>
                                                <th scope="col" style="width:10%;">Max</th>
                                                <th scope="col" style="width:5%;">Monochrome</th>
                                                <th scope="col" style="width:5%;">Color</th>
                                                <th scope="col" style="width:5%;"></th>
                                            </thead>
                                            <tbody id="click_olny_add_row_tbody">
                                                
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="squre EPFClickOnly">
                            <div class="shadow container navbottom pt-2 mt-2">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label for="inputPrinterModel" class="form-label"  style="font-size: 12.4px;">Printer Model</label>
                                        <select type="text" class="form-select" name="epf_printer" id="EpfPrinterModel" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            @foreach ($printers as $printer)
                                                <option value="{{ $printer->id }}">{{ $printer->printer_model }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="inputBaseCommitment" class="form-label"  style="font-size: 12.4px;">Total Mono Prints</label>
                                        <input type="text" class="form-control" name="epf_base_commitment" id="epfCommitment" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="inputMonochrome" class="form-label"  style="font-size: 12.4px;">Monochrome</label>
                                                <input type="text" class="form-control" name="epf_monochrome" id="epfMonochrome" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                            <div class="col">
                                                <label for="inputColor" class="form-label"  style="font-size: 12.4px;">Color</label>
                                                <input type="text" class="form-control" name="epf_color" id="epfColor" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" onclick="EPFAddRow()" class="btn btn-primary float-end" style="height: 28px;font-size: 12.4px;">Add</button>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-9">                                    
                                        <table class="table table-bordered" style="font-size: 11px;" name="data_table" id="data_table">
                                            <thead>
                                                <th scope="col" style="width:30%;">Printer Model</th>
                                                <th scope="col" style="width:10%;">Commitment</th>
                                                <th scope="col" style="width:5%;">Monochrome</th>
                                                <th scope="col" style="width:5%;">Color</th>
                                                <th scope="col" style="width:5%;"></th>
                                            </thead>
                                            <tbody id="epf_add_row_tbody">
                                                
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <br>
                        <br>
                            <div class="col-md-12 align-items-start">
                                <button type="submit" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"> Save</button>
                            </div> 
                        </form>
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
    window.addEventListener("load", function(){
        $(".BaseClick").show();
        $(".topselectionelemnt").hide();
        $(".topselectionelemnt2").hide();
    });

    $(document).ready(function(){
        $("#inputRateCardType").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".squre").not("." + optionValue).hide();
                    $("." + optionValue).show();
                    if((optionValue == "ClickOnlyAvgTotPMode") || (optionValue == "OnlyEveryP") || (optionValue == "EPFClickOnly")){
                        $(".topselectionelemnt").show();
                        $(".topselectionelemnt2").show();
                    } else{
                        $(".topselectionelemnt").hide();
                        $(".topselectionelemnt2").hide();
                    }
                } else{
                    $(".squre").hide();
                }
            });
        }).change();
    });

    function delete_row($this)
    {
        $this.closest('tr').remove();
    }


    function click_olny_add_row()
    {
        $printe_model = $("#inputClickOnlyPrinterModel").find(":selected").text();
        $click_only_avarage_base_commitment = $("#inputClickOnlyCommitment").val(); 
        $click_only_avarage_base_commitment_1= $("#inputClickOnlyCommitment_1").val(); 
        $click_only_avarage_monichrome = $("#inputClickOnlyMonochrome").val();
        $click_only_avarage_color = $("#inputClickOnlyColor").val();

        if($click_only_avarage_base_commitment != "" && $click_only_avarage_base_commitment_1 != "" && $click_only_avarage_monichrome != "" && $click_only_avarage_color != ""){
            $("#click_olny_add_row_tbody").append('<tr><td><input readonly type="text" class="form-control" name="input_click_only_every_printer[]" value="'+$printe_model+'"></td><td><input type="text" class="form-control" name="input_click_only_every_base_commitment[]" value="'+$click_only_avarage_base_commitment+'"></td><td><input type="text" class="form-control" name="input_click_only_every_base_commitment_1[]" value="'+$click_only_avarage_base_commitment_1+'"></td><td><input type="text" class="form-control" name="input_click_only_every_base_monochrome[]" value="'+$click_only_avarage_monichrome+'"></td><td><input type="text" class="form-control" name="input_click_only_every_base_color[]" value="'+$click_only_avarage_color+'"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></td></tr>');
            $("#inputClickOnlyCommitment").val(""); 
            $("#inputClickOnlyCommitment_1").val("");
            $("#inputClickOnlyMonochrome").val("");
            $("#inputClickOnlyColor").val("");
        }else{
            alert("All the fields are required");
        }

    }

    
    function base_click_add_row()
    {
        $printe_model = $("#ClickPrinterModel").find(":selected").text();
        $click_only_avarage_base_commitment = $("#ClickinputBaseCommitment").val(); 
        $click_only_avarage_monichrome = $("#ClickinputMonochrome").val();
        $click_only_avarage_color = $("#ClickinputColor").val();
        if($click_only_avarage_base_commitment  != "" &&$click_only_avarage_monichrome  != "" && $click_only_avarage_color != ""){
            $("#base_click_add_row_tbody").append('<tr><td><input readonly type="text" class="form-control" name="input_base_click_printr_id[]" value="'+$printe_model+'"></td><td><input type="text" class="form-control" name="input_base_click_commitment[]" value="'+$click_only_avarage_base_commitment+'"></td><td><input type="text" class="form-control" name="input_base_click_monochrome[]" value="'+$click_only_avarage_monichrome+'"></td><td><input type="text" class="form-control" name="input_base_click_color[]" value="'+$click_only_avarage_color+'"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></td></tr>');
            $("#ClickinputBaseCommitment").val(""); 
            $("#ClickinputMonochrome").val("");
            $("#ClickinputColor").val("");
        }else{
            alert("All the fields are required");
        }
    }

    function ClickOnlyAvgTotPMode(){
        console.log("412");
        $printe_model = $("#inputPrinterModel").find(":selected").text();
        $click_only_avarage_base_commitment = $("#ClickOnlyAvarageBaseCommitment").val(); 
        $click_only_avarage_base_commitment1 = $("#ClickOnlyAvarageBaseCommitment1").val(); 
        $click_only_avarage_monichrome = $("#ClickOnlyAvarageMonochrome").val(); 
        $click_only_avarage_color = $("#ClickOnlyAvarageColor").val();
        if($click_only_avarage_base_commitment != "" && $click_only_avarage_base_commitment1 != "" && $click_only_avarage_monichrome != "" && $click_only_avarage_color != ""){
            console.log("419")
            $("#click_only_avarage_add_row_tbody").append('<tr><td><input treadonly type="text" class="form-control" name="input_click_only_avarage_base_printer_id[]" value="'+$printe_model+'"></td><td><input type="text" class="form-control" name="input_click_only_avarage_base_commitment[]" value="'+$click_only_avarage_base_commitment+'"></td><td><input type="text" class="form-control" name="input_click_only_avarage_monichrome[]" value="'+$click_only_avarage_monichrome+'"></td><td><input type="text" class="form-control" name="input_click_only_avarage_color[]" value="'+$click_only_avarage_color+'"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></td</tr>');
            $("#ClickOnlyAvarageBaseCommitment").val(""); 
            // $("#ClickOnlyAvarageBaseCommitment1").val("");
            $("#ClickOnlyAvarageMonochrome").val(""); 
            $("#ClickOnlyAvarageColor").val("");
        }else{
            alert("All the fields are required");
        }

    }


    function EPFAddRow(){
        $printe_model = $("#EpfPrinterModel").find(":selected").text();
        $epfCommitment = $("#epfCommitment").val(); 
        $epfMonochrome = $("#epfMonochrome").val(); 
        $epfColor = $("#epfColor").val(); 
        if($epfCommitment != "" && $epfMonochrome != "" && $epfColor != ""){
            $("#epf_add_row_tbody").append('<tr><td><input readonly type="text" class="form-control" name="input_epf_printer[]" value="'+$printe_model+'"></td><td><input type="text" class="form-control" name="input_epf_base_commitment[]" value="'+$epfCommitment+'"></td><td><input type="text" class="form-control" name="input_epf_monochrome[]" value="'+$epfMonochrome+'"></td><td><input type="text" class="form-control" name="input_epf_color[]" value="'+$epfColor+'"></td><td><button type="button" class="btn p-0 add" value="Add Row" onclick="delete_row(this);" style="font-size: 11px;"><i class="bi bi-trash-fill"></i></button></td</tr');
            $("#epfCommitment").val(""); 
            $("#epfMonochrome").val(""); 
            $("#epfColor").val(""); 
        }else{
            alert("All the fields are required");
        }

    }
    
</script> 
@endsection


