@extends('layouts.admin')

@section('content')
<main class="">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Contracts</h3>
                        <p style="font-size: 10px;">You have {{$contracts->count()}} Contracts</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br> 
                    <div class="row">
                        <div class="col-3">
                            <form action="" class="">
                                <div class="input-group mb-3 searchwhite">
                                    <input type="text" class="form-control form-control-sm searchtext" placeholder="Search Here" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                    <button type="submit" class="input-group-text searchbtn" style="height: 29px;font-size: 12.4px;"><i class="bi bi-search me-2 "></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-dark float-start" style="height: 29px;font-size: 12.4px;"><i class="bi bi-sliders me-2"></i>Filters</button>
                        </div>
                        <div class="col">
                            <button type="button" onclick="location.href='/contracts/create'" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"><i class="bi bi-plus p-1"></i>New Contract</button>
                        </div>
                    </div>  
                    <br>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($contracts as $contract)
                        @if($contract->customer)
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="font-size: 12.4px;">
                                    <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree{{$contract->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size: 12.4px;">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckSetup">
                                        <label class="px-2 ">
                                            <i class="bi bi-folder-fill"></i> {{$contract->contract_id}}
                                        </label>
                                        <label class="px-5 ">
                                            <i class="bi bi-building"></i> {{$contract->customer->company_name}}
                                        </label>
                                        <label class="px-5 ">
                                            {{$contract->customer->type}}
                                        </label>
                                        <label class="px-5 ">
                                            12/06/2022
                                        </label>
                                        <label class="px-5 ">
                                            <input class="inputfileaccording" type="file" name="formFile" id="formFile" invisible disabled>
                                            <label for="formFile"><i class="bi bi-paperclip"></i> File Name</label>
                                        </label>
                                    </button>
                                </h2>
                                <div id="flush-collapseThree{{$contract->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                    <div class="row">
                                        <div class="col contractrow">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach($contract->mainPrinters() as $company_printer)
                                                            <tr>
                                                                <td><i class="bi bi-printer mr-1"></i> {{$company_printer->model}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <table class="table justify-content-end">
                                                        <tbody>
                                                            <tr>
                                                                <td>Master Contract</td>
                                                                <td>-</td>
                                                                <td>{{$contract->master_contract}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Addendum 1</td>
                                                                <td>-</td>
                                                                <td>xxxxxxxxxxxxxxxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Addendum 2</td>
                                                                <td>-</td>
                                                                <td>xxxxxxxxxxxxxxxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Addendum 3</td>
                                                                <td>-</td>
                                                                <td>xxxxxxxxxxxxxxxxx</td>
                                                            </tr>
                                                                <tr>
                                                                <td>Addendum 4</td>
                                                                <td>-</td>
                                                                <td>xxxxxxxxxxxxxxxxx</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto float-end">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="/contracts/{{$contract->id}}/edit" class="btn btn-primary" style="height: 29px;font-size: 12.4px;"><i class="bi bi-pencil p-1"></i>Edit</a>&nbsp;
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col">
                                                    <a href="/contracts/{{$contract->id}}/printers" class="btn btn-primary" style="height: 29px;font-size: 12.4px;"><i class="bi bi-printer-fill p-1" ></i>View Printer</a>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col">
                                                    @if($contract->ratecard)
                                                    <a href="/contracts/{{$contract->id}}/ratecrad/{{$contract->ratecard->id}}" class="btn btn-dark" style="height: 29px;font-size: 12.4px;"><i class="bi bi-cash-stack p-1"></i>View Rate Card</a>
                                                    @else
                                                        <a href="/contracts/{{$contract->id}}/rate-crad" class="btn btn-dark" style="height: 29px;font-size: 12.4px;"><i class="bi bi-cash-stack p-1"></i>Add Rate Card</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection