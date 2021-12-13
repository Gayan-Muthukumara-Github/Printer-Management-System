@extends('layouts.admin')

@section('content')
    <main class="">
        <div class="row">
            <div class="col-sm-12 mainbackground">
                <div class="row g-3"> 
                    <h1 class="main-header">Customer details</h1>
                    <div class="row">
                        <a href="/customers/create" name="formcontactsave" class="btn btn-primary float-end col-md-2" style="height: 29px;font-size: 12.4px;"><i class="bi bi-plus p-1"></i>New Customer</a>
                    </div>
                    <br>
                    <br>
                    <div class="shadow container navbottom ">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($customers as $customer)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" style="font-size: 12.4px;">
                                            <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree{{$customer->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size: 12.4px;">
                                                <label class="px-2 ">
                                                    <i class="bi bi-folder-fill"></i> {{ $customer->company_name }}
                                                </label>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree{{$customer->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                            <div class="row">
                                                <div class="col contractrow">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Adress</th><th>City</th><th>Type</th><th>Group Entity</th><th>Type</th><th>Phone Number</th><th>Fax Number</th><th></th>
                                                                        <th>VAT</th><th>SVAT</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $customer->company_address }}</td><td>{{ $customer->city }}</td><td>{{ $customer->type }}</td>
                                                                        <td>{{ $customer->group_entity }}</td><td>{{ $customer->group_entity }}</td><td>{{ $customer->phone_number }}</td><td>{{ $customer->fax_number }}</td><td></td>
                                                                        <td>{{ $customer->vat }}</td><td>{{ $customer->svat }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            @if ($customer->contacts)
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <th>Last Name</th>
                                                                            <th>Mobile Number</th>
                                                                            <th>Landline Number</th>
                                                                            <th>Email</th>
                                                                            <th>Department</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($customer->contacts as $contact)
                                                                            <tr>
                                                                                <td>{{ $contact->first_name }}</td>
                                                                                <td>{{ $contact->last_name }}</td>
                                                                                <td>{{ $contact->mobile }}</td>
                                                                                <td>{{ $contact->land_line }}</td>
                                                                                <td>{{ $contact->email }}</td>
                                                                                <td>{{ $contact->department }}</td>

                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif
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
        </div>
    </main>
@endsection