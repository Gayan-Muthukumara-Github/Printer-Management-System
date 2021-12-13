@extends('layouts.admin')

@section('content')
    <main class="">
        <div class="m-3">
            <div class="row mainbackground">
                <div class="col-sm-12 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header" >Printer Catalog</h3>
                            <p style="font-size: 10px;">You have 23 Printers</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="row">
                            <div class="col-md-3">
                                <form action="" class="">
                                    <div class="input-group mb-3 searchwhite">
                                        <input type="text" class="form-control form-control-sm searchtext" placeholder="Search Here" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" required>
                                        <button type="submit" class="input-group-text searchbtn" style="height: 29px;font-size: 12.4px;"><i class="bi bi-search me-2 "></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-dark float-start" style="height: 29px;font-size: 12.4px;"><i class="bi bi-sliders me-2"></i>Filters</button>
                            </div>
                            <div class="col">
                                <a type="button" href="/printers/create" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;"><i class="bi bi-printer-fill"></i>New Printer</a>
                            </div>
                        </div>
                        <br>

                        <!-- Loop start from here -->
                        @foreach ($printers as $printer)
                            <form action="{{ url('/printers', ['id' => $printer->id]) }}" method="post" id="deleterole{{$printer->id}}">
                                @method('delete')
                                @csrf
                            </form>
                            <div class="shadow p-3 mb-5 bg-white rounded">
                                <div class="row g-3">
                                    <div class="col-md-7">
                                        <h6 style="font-size: 16px;font-weight: 600;">{{ $printer->brand}}</h6>   
                                    </div>
                                    <div class="col-md-5 pb-0">
                                        <label class="pb-0">Toner Compatibility</label>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="/storage/{{$printer->image}}" class="rounded img-thumbnail" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <table class="table printertumblinefontsize">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="table-light">Part Number</th>
                                                    <td>{{ $printer->port_number}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">Brand</th>
                                                    <td>{{ $printer->brand}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">Model</th>
                                                    <td>{{ $printer->model}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">Function</th>
                                                    <td>{{ $printer->function}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">Monthly Duty Cycle</th>
                                                    <td>{{ $printer->monthly_duty_cycle}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">Rec. Monthly Page Volume</th>
                                                    <td>{{ $printer->recommended_monthly_page_volum}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-5">
                                        <table class="table table-borderless printertumblinefontsize">
                                            <thead>
                                            <tr>        
                                                <th>Part Nnumber</th>
                                                <th>Name</th>
                                                <th>Duty Cycle</th>
                                                <th>Cost</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($printer->toners()->get() as $toner)
                                                    <tr>        
                                                        <td>{{$toner->part_number}}</td>
                                                        <td>{{$toner->name}}</td>
                                                        <td>{{$toner->duty_cycle}}</td>
                                                        <td class="text-end">{{number_format($toner->cost)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>              
                                </div>
                                @if(Auth::user()->admin == 1)
                                    <a class="btn p-0 float-end pl-2" onclick="if (confirm('Do you want to delete')){ $('#deleterole{{$printer->id}}').submit(); }"><i class="bi bi-archive-fill"></i></a>
                                @endif
                                <br>
                            </div>
                        @endforeach
                        <!-- loop end here -->
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByClassName("role-name")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            } else {
            li[i].style.display = "none";
            }
        }
        }
    </script>
@endsection