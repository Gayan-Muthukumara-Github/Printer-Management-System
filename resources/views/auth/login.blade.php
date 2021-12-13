@extends('layouts.app')

@section('content')
    <div class="row indexback">
        <div class="col-lg-7">
            <img src="/Printer Project.png" class="imagesize" alt="icon">
        </div>
        <div class="col-lg-5">
            <div class="row align-items-center pt-5 mt-5">
                <div class="col align-self-center px-5">
                    <h1 class="mps-login">Managed Print Services</h1>
                    <br>
                    <h5 class="mt-3 px-3 sign-in-page">Sign In</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row px-3">
                            <div class="col-md-7">
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row px-3 mt-2">
                            <div class="col-md-7">
                                <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: #F7F8FA;border: 1px solid #D5DAE5;height: 25.92px;font-size: 12.4px;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row px-3 mt-2">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-check-label">
                                        <a href="/password/reset">Forgot Password?</a> 
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div> 
                        <br>  
                        <div class="row px-3 mt-2">
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-danger float-end">Login</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row px-3 mt-2">
                        <div class="col-md-8">
                            <label>By logging into the solution</label>
                            <br>
                            <a href="#" class="link-info">Terms and Conditions & Privacy Policy</a>
                        </div>
                    </div>             
                </div>
            </div>
        </div>
    </div>

@endsection
