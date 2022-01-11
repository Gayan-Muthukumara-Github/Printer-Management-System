
@extends('layouts.admin')

@section('content')

<main class="">
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Data Feed Upload</h3>
                        <p style="font-size: 10px;">Upload data feeds to maintain updated information.</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br>   
                    <div class="shadow container navbottom ">
                        <form class="row g-3" method="POST" action="/datafeed" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
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
                            <div class="col-md-12">
                                <h5 class="sub-header">Today’s Data Feed</h5>
                                <br>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <select id="inputCountry" name="datafeedtype" class="form-select" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 11px;" required>
                                        <option value="page_count" selected>Page count details</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <label class="form-label" style="font-size: 12.4px;">Last updated on the : 25th of July 2021</label> -->
                                    <div class="row align-items-end">
                                        <div class="col-md-3">
                                            <label for="select_company">Date</label>
                                            <input required class="form-control" type="date" name="date" id="date" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" style="font-size: 12.4px;">Upload CSV file</label>
                                            <input required class="form-control" type="file" name="datafeedfile" id="inputFile" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary" style="height: 27px;font-size: 12.4px;">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-6">
                            <br>
                            <br>
                            <table class="table table-striped table-hover" style="font-size: 12.4px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Customer Details</th>
                                        <th scope="col">Total Printers</th>
                                        <th scope="col">Details Received</th>
                                    </tr>
                                </thead>
                                <tbody>
{{--                                    @foreach($all_customers as $all_customer)--}}
                                    <tr>
                                        <td>{{$all_customers}}</td>
                                        <td>{{$total_printers}}</td>
                                        <td>{{$received_printers}}</td>
                                    </tr>
{{--                                    @endforeach--}}
                                    
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection