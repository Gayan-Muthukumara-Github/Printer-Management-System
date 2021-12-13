@extends('layouts.app')

@section('content')
<main class="container col mainbackground">
    <div class="m-3">
        <div class="row mainbackground">
            <div class="col mainbackground">
                <div class="mt-3 ml-2">
                    <div>
                        <h3 class="main-header">Welcome to the Customer Portal</h3>
                        <p style="font-size: 10px;">Please use the following options to request for the service that you want.</p>
                        <div class="pb-2">
                            <hr>
                        </div>
                    </div>   
                    <br> 
                    <div class="row">
                        <div class="col-md-6">
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
                            <div class="container">
                                <form method="POST" action="/customer-portal/results" class="row">
                                    @csrf
                                    <div class="col-md-4">
                                        <label for="contract_id" class="form-label"  style="font-size: 12.4px;">Contract ID</label><br />
                                        <input type="email" class="form-control" id="contract_id" name="contract_id" required>
                                    </div>
                                    <div class="col-md-4">
                                        <br />
                                        <button type="submit" class="btn btn-primary" style="height: 30px;font-size: 12px;" id="verify">Verify</button>
                                    </div>
                                    <p class="form-label"  style="font-size: 12.4px;">A link will be sent to your registered email</p>
                                </form>
                            </div>
                        </div>
                    </div>                      
                    <br>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
