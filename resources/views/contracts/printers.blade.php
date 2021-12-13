@extends('layouts.admin')

@section('content')

<main class="">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col-sm-12 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Printers</h3>
                        <p style="font-size: 10px;">You have {{$printers->count()}} Printers 
                            <span class="px-2">
                                <i class="bi bi-building"></i>   {{$contract->customer->company_name}} 
                            </span> 
                            <span class="px-3">  <i class="bi bi-folder-fill"></i> {{$contract->id}}
                            </span>
                        </p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-3">
                            <form action="" class="">
                                <div class="input-group mb-3 searchwhite">
                                    <input type="text" class="form-control form-control-sm searchtext" placeholder="Search Here" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                    <button type="submit" class="input-group-text searchbtn" style="background-color: #F7F8FA;height: 29px;font-size: 12.4px;"><i class="bi bi-search me-2 "></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark float-start" style="height: 29px;font-size: 12.4px;"><i class="bi bi-sliders me-2"></i>Filters</button>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-auto">
                            <div class="row">
                                <div class="col-auto ">
                                    <button type="button" class="btn btn-light position-relative" style="font-size: 12.4px;">
                                        <span class="align-middle">
                                            <i class="bi bi-printer-fill">
                                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                                                {{$num_models}}
                                                </span>
                                            </i> Models
                                        </span>    
                                    </button>        
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-light position-relative" style="font-size: 12.4px;">
                                        <span class="align-middle">
                                        <i class="bi bi-geo-alt-fill">
                                            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                                                {{$num_department}}
                                            </span>
                                        </i> Location
                                        </span>
                                    </button>                                                 
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-light position-relative" style="font-size: 12.4px;">
                                        <span class="align-middle">
                                            <i class="bi bi-bezier2">
                                            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                                                {{$con_method}}
                                            </span>
                                            </i> Connection
                                        </span>
                                    </button>                                     
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-light position-relative" style="font-size: 12.4px;">
                                        <span class="align-middle"> 
                                            <i class="bi bi-arrow-repeat">
                                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                                                {{$duplicates}}
                                                </span>
                                            </i> Duplicate
                                        </span>     
                                    </button>                 
                                </div>
                                <div class="col-auto">
                                    <form class="row  align-items-end" method="GET" action="/contracts/{{$contract->id}}/check_printers" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"> <i class="bi bi-printer-fill"></i> Check Printers</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="shadow container navbottom ">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="row align-items-end">
                                    <div class="col-md-12">
                                        <div class="row align-items-end">
                                            <div class="col-md-4">
                                                <label for="inputDipCostStartDate" class="form-label printerfontsize" style="font-size: 12.4px;">Dip. Cost Start Date</label>
                                                <input type="text" class="form-control" id="inputDipCostStartDate" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputPrinterModelDipCost" class="form-label printerfontsize" style="font-size: 12.4px;">Printer Model Dip. Cost</label>
                                                <input type="text" class="form-control" id="inputPrinterModelDipCost" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-light float-end" style="height: 29px;font-size: 12.4px;"> <i class="bi bi-arrow-clockwise"></i> Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <form class="row  align-items-end" method="POST" action="/contracts/{{$contract->id}}/bulk_printers" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                    <div class="col-md-4 align-items-end">
                                        <label for="inputPrinterModelDipCost" class="form-label printerfontsize" style="font-size: 12.4px;"></label>
                                        <input required class="form-control" accept=".csv" type="file" name="file" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"> <i class="bi bi-printer-fill"></i> Bulk Upload</button>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                    </div>
                    <table class="table printertablefontsize">
                        <thead>
                            <tr>
                                <th rowspan="2" scope="col"></th>
                                <th rowspan="2" scope="col">Serial Number</th>
                                <th rowspan="2" scope="col">Model</th>
                                <th rowspan="2" scope="col">Status</th>
                                <th rowspan="2" scope="col">Dip. Cost</th>
                                <th rowspan="2" scope="col">Company/ Branch</th>
                                <th rowspan="2" scope="col">Department</th>
                                <th rowspan="2" scope="col">Con. Method</th>
                                <th rowspan="2" scope="col">Installation Date</th>
                                <th colspan="2" scope="col">Start Page Count</th>
                                <th rowspan="2" scope="col">Duty Cycle</th>
                            </tr>
                            <tr>
                                <th>B/W</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($printers as $printer)
                                <tr>
                                    <th scope="row"> <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></th>
                                    <td>{{$printer->serial_number}}</td>
                                    <td>{{$printer->printer_model}}</td>
                                    <td>{{$printer->status}}</td>
                                    <td>{{$printer->dip_cost}}</td>
                                    <td>{{$printer->branch}}</td>
                                    <td>{{$printer->department}}</td>
                                    <td>{{$printer->con_method}}</td>
                                    <td>{{$printer->installation_at}}</td>
                                    <td>{{$printer->start_page_count}}</td>
                                    <td>{{$printer->start_page_count_color}}</td>
                                    <td>{{$printer->duty_cycle}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection