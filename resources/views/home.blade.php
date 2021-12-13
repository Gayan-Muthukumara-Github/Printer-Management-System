@extends('layouts.admin')

@section('content')
<main class="">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Dashboard !</h1>
                    <p>{{ Auth::user()->system_owner }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
