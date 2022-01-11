@extends('layouts.pdf')

@section('content')

    <main class="">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="row g-3">

                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="sub-header display-1 " style="font-size: 45px;margin-left: 370px;">TAX
                                INVOICE</h1>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <table style="width: 100%;font-size: 8pt;">
                                @foreach($customer as $c)
                                    <tr>
                                        <td><span>Company :</span> {{$c->company_name}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>Invoice Number : 01</td>
                                    </tr>
                                    <tr>
                                        <td><span>Vat :</span> {{$c->vat}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>Date : {{$date_today}}</td>
                                    </tr>
                                    <tr>
                                        <td><span>Address :</span> {{$c->company_address}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>Page No : 01</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <br>
                            </div>
                            <table style="font-size: 8pt;">
                                @foreach($contract as $c)
                                    <tr>
                                        <td>Contract ID : {{$c->contract_id}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Contarct Name : {{$c->name}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Contarct Period :</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Billing Period :</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <br>
                            <br>
                            <h3 style="font-size: 8pt; ">Monthly invoice value for Monochrome Prints</h3>
                        </div>
                        <div class="col-md-12">
                            <table style="font-size: 8pt;" align="right">
                                <tr>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                </tr>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>#Of Units&nbsp;&nbsp;&nbsp;</th>
                                    <th>Base Value(LKR)&nbsp;&nbsp;&nbsp;</th>
                                    <th>Total Printouts&nbsp;&nbsp;&nbsp;</th>
                                    <th>Per Unit(LKR)&nbsp;&nbsp;&nbsp;</th>
                                    <th>Total Price(LKR)&nbsp;&nbsp;&nbsp;</th>
                                </tr>
                                <tr>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                </tr>
                                @foreach($invoice as $i)
                                    <tr>
                                        <td>{{$i->model}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->Num_PRNT}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->commitment}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->Tot_Mono}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->monochrome}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{number_format((float) $i->Tot_MonoCharges, 2, '.', '')}}
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>

                                <h3 style="font-size: 8pt; ">Monthly invoice value for Color Prints</h3>
                            </div>
                            <table style="font-size: 8pt; " align="right">
                                <tr>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                </tr>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>#Of Units&nbsp;&nbsp;&nbsp;</th>
                                    <th>Base Value(LKR)&nbsp;&nbsp;&nbsp;</th>
                                    <th>Total Printouts&nbsp;&nbsp;&nbsp;</th>
                                    <th>Per Unit(LKR)&nbsp;&nbsp;&nbsp;</th>
                                    <th>Total Price(LKR)&nbsp;&nbsp;&nbsp;</th>
                                </tr>
                                <tr>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                    <th>
                                        <hr>
                                    </th>
                                </tr>
                                @foreach($invoice as $i)
                                    <tr>
                                        <td>{{$i->model}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->Num_PRNT}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->commitment}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->Tot_Color}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{$i->color}}&nbsp;&nbsp;&nbsp;</td>
                                        <td style="text-align:right">{{number_format((float) $i->Tot_ColorCharges, 2, '.', '')}}
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-sm-12">
                            <table style="font-size: 8pt;" align="right">
                                <tr>
                                    <th>&emsp;</th>
                                    <th>&emsp;</th>

                                </tr>
                                <tr>
                                    <th>&emsp;</th>
                                    <th>
                                        <hr>
                                    </th>

                                </tr>
                                <tr>
                                    <th>Sub Total</th>
                                    <td>{{number_format((float) $subtotal, 2, '.', '')}}</td>
                                </tr>
                                <tr>
                                    <th>&emsp;</th>
                                    <th>
                                        <hr>
                                    </th>

                                </tr>
                                <tr>
                                    <th>8% Total</th>
                                    <td>{{number_format((float) $tax, 2, '.', '')}}</td>
                                </tr>
                                <tr>
                                    <th>&emsp;</th>
                                    <th>
                                        <hr>
                                    </th>

                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td>{{number_format((float) $totalamount, 2, '.', '')}}</td>
                                </tr>
                                <tr>
                                    <th>&emsp;</th>
                                    <th>
                                        <hr>
                                    </th>

                                </tr>

                            </table>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-12" style="font-size: 8pt;">
                            <h5>Cheques should be drawn in favor of " V S Information Systems (Pvt) Ltd.</h5>
                            <h5>and Crossed "A/C payee Only".</h5>
                            <p>..............................</p>
                            <p>Signature of the customer / Authorized Signature</p>
                            <p>Name:.........................</p>
                            <p>Date:.........................</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection






