@extends('layouts.admin')

@section('content')
    <main class="">
        <div class="m-3">
            <div class="row mainbackground">
                <div class="col-sm-12 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header" >Price List</h3>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="row">
                            <div class="col">
                                <a type="button" href="/pricelists/create" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"><i class="bi bi-plus p-1"></i>New Price List</a>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($pricelists as $pricelist)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" style="font-size: 12.4px;">
                                        <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree{{$pricelist->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size: 12.4px;">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckSetup">
                                            <label class="px-2 ">
                                                <i class="bi bi-folder-fill"></i> {{$pricelist->contract->contract_id}}
                                            </label>
                                            <label class="px-5 ">
                                                <i class="bi bi-building"></i> {{$pricelist->contract->customer->company_name}}
                                            </label>
                                            <label class="px-5 ">
                                                {{$pricelist->printer->model}}
                                            </label>
                                            <label class="px-5 ">
                                                {{$pricelist->printer->port_number}}
                                            </label>
                                            <label class="px-5 ">
                                                {{$pricelist->currency}} {{number_format($pricelist->price)}} 
                                            </label>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree{{$pricelist->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                        <div class="row">
                                            <div class="col contractrow">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Part Number</th><th>Name</th><th>Purchase Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($pricelist->toner_lists as $toner)
                                                                    <tr>
                                                                        <td>{{$toner->toner->part_number}}</td><td>{{$toner->toner->name}}</td><td>{{$toner->price}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection