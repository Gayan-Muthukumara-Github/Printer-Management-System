@extends('layouts.admin')

@section('content')
<main class="">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Dispatch</h3>
                        <p style="font-size: 10px;">Dispatch Details</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br> 
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(session()->has('alert'))
                                <div class="alert alert-danger">
                                    {{ session()->get('alert') }}
                                </div>
                            @endif
                            <div class="shadow container navbottom">
                                <div class="row">
                                    <h3>Service Request</h3>
                                    <div class="col-md-4">
                                        <div class="request-card card">
                                            <div class="list-group">
                                                @foreach($customerRequests as $customerRequest)
                                                    <a href="#" class="list-group-item list-group-item-action {{$customerRequest->status=='completed' ? 'disabled' : ''}}" onclick="getRequest(this, '{{$customerRequest->id}}');">
                                                        {{$customerRequest->customer->company_name}}&nbsp;{{$customerRequest->customer->company_address}} {{$customerRequest->contact->department}}<br>
                                                        <b>Requested By: {{$customerRequest->contact->first_name}} {{$customerRequest->contact->mobile}}</b>
                                                        <p>{{$customerRequest->request_type}}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 request-card card" id="request_details_id">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                      
                    <br>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getRequest(element, id){
            $(".list-group-item").removeClass('active');
            $(element).addClass("active");
            $.get("/dispatch/get_requests/"+id, function(response) {
                $('#request_details_id').html(response);
            });
        }
    </script>

</main>
@endsection
