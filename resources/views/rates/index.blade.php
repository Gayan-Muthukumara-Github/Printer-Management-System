@extends('layouts.admin')

@section('content')
    <main class="">
        <div class="m-3">
            <div class="row mainbackground">
                <div class="col-sm-9 mainbackground">
                    <div class="mt-3 ml-2">
                        <div>
                            <h3 class="main-header">Rates & Rules</h3>
                            <p style="font-size: 10px;">User the form below to enter your employees' details and their system roles.</p>
                            <div class="pb-2">
                                <hr>
                            </div>
                        </div>   
                        <br>   
                        <div class="shadow container navbottom ">
                            <form method="POST" action="/rates" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="sub-header">Rate Details</h5>
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
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-12">
                                            <h5 class=""  style="font-size: 16px;font-weight: 600;">Todays</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <label for="rate" class="form-label" style="font-size: 12.4px;">US Doller Rate (USD 1)</label>
                                                <input type="text" class="form-control" name="rate" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="inputCompanyName"  required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row g-3 align-items-end">
                                            <div class="col-md-12">
                                                <h5 class=""  style="font-size: 16px;font-weight: 600;">Billing Cycle</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="start_at" class="form-label" style="font-size: 12.4px;">Start Date</label>
                                                <input type="date" class="form-control" name="start_at" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="inputCompanyName"  required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="end_at" class="form-label" style="font-size: 12.4px;">End Date</label>
                                                <input type="date" class="form-control" name="end_at" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;" name="inputCompanyName"  required>
                                            </div>
                                            <div class="col-auto">
                                                <!-- <button type="submit" for="formbilling" name="formupdate" class="btn btn-primary float-end" style="height: 29px;font-size: 12.4px;">Update</button> -->
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <br>
                            <br>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-sm-3" >
                    <div class="mt-3 ml-2">
                        <h6 class="sub-header">Rates & Rules</h6>
                    </div>
                    <br>
                    <div class="container p-0">
                        <div class="row p-0">
                            <div class="radio-toolbar">
                                <div class="row">
                                    <div class="col-auto">
                                        <input type="radio" id="radioFName" name="radioLeftMenu" value="FName" checked>
                                        <label for="radioFName" style="font-size: 12.4px;">Rate, Start Date and End Date</label>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <hr class="hrdriverTop">
                        <div class="box FName">
                            <div>
                                <form action="" class="">
                                    <div class="input-group mb-3">
                                    <input id="myInput" type="text" class="form-control form-control-sm searchtext" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;"  placeholder="Search Here" onkeyup="myFunction()">
                                    </div>
                                </form>
                            </div>
                            <ul id="myUL">
                                @foreach ($rates as $rate)
                                    <li>
                                        <div class="row searchrow">
                                            <div class="col-auto"><i class="bi bi-three-dots-vertical"></i></div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-auto role-name">
                                                    {{$rate->rate}} / {{$rate->start_at}} / {{$rate->end_at}}
                                                    </div>
                                                </div>      
                                            </div> 
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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