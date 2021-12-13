@extends('layouts.admin')
@section('content')

<main class="">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col-sm-12 mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="">Rate Card Contract ID {{$contract->contract_id}}</h3>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br>   
                    <div class="shadow container navbottom">
                        <div class="row g-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th>Apply Exchange</th>
                                        <th>Exchange Different</th>
                                        <th>Monochrome</th>
                                        <th>Print Volume</th>
                                        <th>Group Wise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{$ratecard->customer->company_name}}</th>
                                        <th>{{$ratecard->get_type()}}</th>
                                        <th>{{$ratecard->apply_exchange}}</th>
                                        <th>{{$ratecard->exchange_diff}}</th>
                                        <th>{{$ratecard->monochrome}}</th>
                                        <th>{{$ratecard->print_volume}}</th>
                                        <th>{{$ratecard->group_wise}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Printer Model</th><th>Commitment</th><th>Commitment Max</th><th>Monochrome</th><th>Color</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ratecard->ratecard_printers as $ratecard_printer)
                                        <tr>
                                            <td>{{$ratecard_printer->printer->model}}</td>
                                            <td>{{$ratecard_printer->commitment}}</td>
                                            <td>{{$ratecard_printer->commitment_1}}</td>
                                            <td>{{$ratecard_printer->monochrome}}</td>
                                            <td>{{$ratecard_printer->color}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection