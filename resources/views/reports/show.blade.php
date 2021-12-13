@extends('layouts.pdf')

@section('content')

    <main class="">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="row g-3"> 

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="sub-header"></h5>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <table style="width: 100%">
                                <tr>
                                    <td><h3>{{$contract->customer->company_name}}</h3></td>
                                    <td><h1>TAX INVOICE</h1></td>
                                </tr>
                                <tr>
                                    <td>{{$contract->customer->vat}}</td>
                                    <td>Invoice Number</td>
                                </tr>
                                <tr>
                                    <td>{{$contract->customer->company_address}}</td>
                                    <td>Invoice Date</td>
                                </tr>
                                <tr><td>HP Managed Print Services</td><td></td></tr>
                                <tr><td>Contract Period: </td><td>Immediately</td></tr>
                                <tr><td></td><td></td></tr>
                            </table>
                        </div>
                        <table>
                            <?php $total_amount = 0; ?>
                            @foreach ($datafeed->droup_by_printer_model() as $detail)
                                <tr>
                                    <td><strong>{{$datafeed->com_printer($detail->printer_id)->model}}</strong></td>
                                    <td><?php $units = $detail->total; ?></td>
                                    <td><strong>{{ $units }} Units</strong></td>>
                                    <td></td>
                                </tr>
                                <tr>total
                                    <td></td>
                                    <td><strong># Prints</strong></td>
                                    <td><strong>Unit (LKR)</strong></td>
                                    <td><strong>Total (LKR)</strong></td>
                                </tr>
                                <tr>
                                    <td>Monthly invoice value for Monochrome Prints</td>
                                    <td>
                                        <?php $avg_mono = intval($datafeed->avarage_monochrome($detail->printer_id)); ?>
                                        <?php $unit_price_mono = $ratecard->ratecard_printer_monochrome($avg_mono) ?>
                                        @if($ratecard->type == "BaseClick")
                                            {{$unit_price_mono->commitment}}
                                        @else
                                            {{$unit_price_mono->commitment_1}}
                                        @endif
                                    </td>
                                    <td>{{$unit_price_mono->monochrome}}</td>
                                    <td><?php $tot_mono = $datafeed->total_amount_mono($units, $unit_price_mono) ?> {{number_format($tot_mono,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Monthly Invoice value for Color Prints</td>
                                    <td>
                                        <?php $avg_color = intval($datafeed->avarage_colour($detail->printer_id)); ?>
                                        <?php $unit_price_colour = $ratecard->ratecard_printer_color($avg_color) ?>
                                    @if($ratecard->type == "BaseClick")
                                        {{$unit_price_colour->commitment}}
                                    @else
                                        {{$unit_price_colour->commitment_1}}
                                    @endif
                                    </td>
                                    <td> {{$unit_price_colour->color}}</td>
                                    <td><?php $tot_color = $datafeed->total_amount_colour($units, $unit_price_colour); ?>{{number_format($tot_color, 2)}}</td>
                                </tr>
                                <?php $total_amount = $total_amount + $tot_mono + $tot_color ?>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Sub Total</td>
                                <td></td>
                                <td>{{number_format($total_amount,2)}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>8% Total</td>
                                <td></td>
                                <td>{{number_format(intval($total_amount) * 0.08,2) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><strong>Total Amount</strong></td>
                                <td></td>
                                <td><strong>{{number_format(intval($total_amount) + intval($total_amount) * 0.08,2)}}</strong></td>
                            </tr>
                        </table>
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

@endsection






