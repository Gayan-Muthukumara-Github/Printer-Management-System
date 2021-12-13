<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/css/Custom.css') }}" rel="stylesheet">
        <link href="{{ asset('/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <main class="py-4">
            <!-- Top nav bar -->
            <div class="fixed-top">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"></a>
                        <div class="d-flex">
                            <div class="me-2">
                            <a id="" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>
                            </div>
                            <div class="">
                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Bottom nav bar -->
                <nav class="navbar navbar-expand-lg navbar-light navbottom border-bottom">
                    <div class="container-fluid p-0 m-0">
                    <a class="navbar-brand px-5 p-0 m-0" href="#">
                        <div class="p-0 m-0">
                            @if (Auth::check() && Auth::user()->system_owner == 1)
                                <img src="/1.png" alt="Company Logo" width="80" height="35">
                            @else
                                <img src="/storage/{{Auth::user()->company->logo}}" alt="Company Logo" height="35" width="80">
                            @endif
                        </div>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        <li class="nav-item px-5">
                        @if (Auth::user()->system_owner == 0 && Auth::user()->company->rates->last())
                            Today’s Exchange Rate 1 USD = LKR {{Auth::user()->company->rates->last()->rate}}
                        @endif
                        
                        </li>
                        </ul>
                    </div>
                    </div>
                </nav>
                <!-- Bottom nav bar -->
            </div>
        </main>
        <div class="row">
            <div class="col-md-2">
            <div class="">
            <div class="offcanvas-body">
              <nav>
                <ul class="navbar-nav">
                    <div class="row">
                        <div class="col-sm-12">
                        <li>
                        <a href="/home" class="nav-link active text-dark">
                        <div class="px-1" style="font-size: 12px;font-weight: 600;">
                            Dashboard
                        </div>
                    </a>
                    </li>
                    </div>
                    </div>
                   
                </ul>
                <div>
                    <hr>
                  </div>
                <div class="dashboard-color" style="font-size: 12px;font-weight: 600;">
                    Setup
                </div>
                <div>
                    <hr class="hrdriver">
                </div>
                @if(Auth::user()->system_owner == 1 || Auth::user()->havePermission('viewcompanydetails') || Auth::user()->havePermission('addcompanydetails') || Auth::user()->havePermission('editcompanydetails'))
                <a href="/companies" class="nav-link text-dark active sideText {{ (Request::is('companies/*') || Request::is('companies') || Request::is('companies/*') ? 'sideactive' : '') }}">
                    <div>
                        Company
                    </div>
                    </a> 
                <div>
                    <hr class="hrdriverlink">
                </div>
                @endif
                @if (Auth::user()->system_owner == 0)
                @if(Auth::user()->havePermission('createuserroles') || Auth::user()->havePermission('edituserroles') || Auth::user()->havePermission('deleteuserroles'))
                <a href="/roles" class="nav-link active text-dark sideText {{ (Request::is('roles/*') || Request::is('roles') || Request::is('roles/*') ? 'sideactive' : '') }}">
                    <div>
                        Roles
                    </div>
                </a> 
                <div>
                    <hr class="hrdriverlink">
                </div>
                @endif
                @if(Auth::user()->havePermission('viewuserdetails') || Auth::user()->havePermission('adduserdetails') || Auth::user()->havePermission('edituserdetails'))
                <a href="/users" class="nav-link active text-dark sideText {{ (Request::is('users/*') || Request::is('users') || Request::is('users/*') ? 'sideactive' : '') }}">
                    <div>
                        Users
                    </div>
                </a>
                <div>
                    <hr class="hrdriverlink">
                </div>
                @endif
                <a href="/rates" class="nav-link active text-dark sideText {{ (Request::is('rates/*') || Request::is('rates') || Request::is('rates/*') ? 'sideactive' : '') }}">
                    <div>
                        Rates & Rules
                    </div>
                </a>
                <div>
                    <hr class="hrdriverTop">
                </div>
                <div class="" style="font-size: 12px;font-weight: 600;">
                    Contract
                </div>
                <div>
                    <hr class="hrdriver">
                </div>
                <a href="/contracts" class="nav-link active text-dark sideText {{ (Request::is('contracts/*') || Request::is('contracts') || Request::is('contracts/*') ? 'sideactive' : '') }}">
                    <div>
                        New Contract
                    </div>
                </a>
                <div>
                    <hr class="hrdriverlink">
                </div>
                <a href="/pricelists" class="nav-link active text-dark sideText">
                    <div>
                        Price List
                    </div>
                </a>
                <div>
                    <hr class="hrdriverTop">
                </div>
                <div class="" style="font-size: 12px;font-weight: 600;">
                    Customer
                </div>
                <div>
                    <hr class="hrdriver">
                </div>
                <a href="/customers" class="nav-link active text-dark sideText {{ (Request::is('customers/*') || Request::is('customers') || Request::is('customers/*') ? 'sideactive' : '') }}">
                    <div>
                        Customer Catalog
                    </div>
                </a>
                <div>
                    <hr class="hrdriverTop">
                </div>
                <div class="" style="font-size: 12px;font-weight: 600;">
                    Printer
                </div>
                <div>
                    <hr class="hrdriver">
                </div>
                <a href="/printers" class="nav-link active text-dark sideText {{ (Request::is('printers/*') || Request::is('printers') || Request::is('printers/*') ? 'sideactive' : '') }}">
                    <div>
                        Printer Catalog
                    </div>
                </a>
                <div>
                    <hr class="hrdriverTop">
                </div>
                <div class="" style="font-size: 12px;font-weight: 600;">
                    Daily
                </div>
                <div>
                    <hr class="hrdriver">
                </div>
                <a href="/datafeed" class="nav-link active text-dark sideText {{ (Request::is('datafeed/*') || Request::is('datafeed') || Request::is('datafeed/*') ? 'sideactive' : '') }}">
                    <div>
                        Data Feed Upload
                    </div>
                </a>
                <div>
                    <hr class="hrdriverlink">
                </div>
                <a href="/reports" class="nav-link active text-dark sideText {{ (Request::is('reports/*') || Request::is('reports') || Request::is('reports/*') ? 'sideactive' : '') }}">
                    <div>
                        Reports
                    </div>
                </a>
                <div>
                    <hr class="hrdriverlink">
                </div>
                <a href="/dispatch" class="nav-link active text-dark sideText {{ (Request::is('dispatch/*') || Request::is('dispatch') || Request::is('dispatch/*') ? 'sideactive' : '') }}">
                    <div>
                        Dispatch
                    </div>
                </a>
                <div>
                    <hr class="hrdriverTop">
                </div>
                @endif
              </nav>
            </div>
          </div>
        <!--Left side bar -->
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>

        </div>
    </body>
</html>
