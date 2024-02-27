

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- CSRF Token -->


<head>
    <meta charset="utf-8" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Scripts -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IT.SN VENTE</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="IT.SN VENTE">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/icomoon/style.css')}}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
</head>

<body>

<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- App container starts -->
    <div class="app-container">

        <!-- App navbar starts -->
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container">
                <div class="offcanvas offcanvas-end" id="MobileMenu">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title semibold">Navigation</h5>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                            <i class="icon-clear"></i>
                        </button>
                    </div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @canany(['create-role', 'edit-role', 'delete-role'])
                                <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Roles</a></li>
                            @endcanany
                            @canany(['create-customer', 'edit-customer', 'delete-customer'])
                                <li><a class="nav-link" href="{{ route('customers.index') }}">Manage Customers</a></li>
                            @endcanany
                            @canany(['create-user', 'edit-user', 'delete-user'])
                                <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                            @endcanany
                            @canany(['create-product', 'edit-product', 'delete-product'])
                                <li><a class="nav-link" href="{{ route('products.index') }}">Manage Products</a></li>
                            @endcanany
                            @canany(['create-category', 'edit-category', 'delete-category'])
                                <li><a class="nav-link" href="{{ route('category.index') }}">Manage Category</a></li>
                            @endcanany
                                @canany(['create-order', 'edit-order', 'delete-order'])
                                    <li><a class="nav-link" href="{{ route('orders.index') }}">Manage Orders</a></li>
                                @endcanany
                                <div class="dropdown ms-2">
                                    <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="d-none d-md-block"></span>
                                        <img src="{{asset('assets/images/user3.png')}}" class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3" style="">
                                        <a class="dropdown-item d-flex align-items-center py-2" href="agent-profile.html"><i
                                                class="icon-smile fs-4 me-3"></i>{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="account-settings.html"><i
                                                class="icon-settings fs-4 me-3"></i>Account
                                            Settings</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                            <i class="icon-log-out fs-4 me-3"></i>{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                        @endguest

                    </ul>
                </div>
            </div>

        </nav>
        <!-- App Navbar ends -->

        <!-- App body starts -->
        <div class="app-body">

            <!-- Container starts -->
            <div class="container">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div style="padding-top: 130px;">
                    @yield('content')
                </div>

            </div>
            <!-- Container ends -->

        </div>
        <!-- App body ends -->

        <!-- App footer start -->
        <div class="app-footer">
            <div class="container">
                <span>© M. SEMS 2024 CodingInProgess </span>
            </div>
        </div>
        <!-- App footer end -->

    </div>
    <!-- App container ends -->

</div>
<!-- Page wrapper end -->

<!-- *************
        ************ JavaScript Files *************
    ************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- *************
        ************ Vendor Js Files *************
    ************* -->

<!-- Overlay Scroll JS -->
<script src="{{asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

<!-- Apex Charts -->
<script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/ticketsData.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/avgTimeData.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/liveCallsData.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/agentsLiveData.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/ticketsPriorityData.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/home/newClosedData.js')}}"></script>

<!-- Rating -->
<script src="{{asset('assets/vendor/rating/raty.js')}}"></script>
<script src="{{asset('assets/vendor/rating/raty-custom.js')}}"></script>

<!-- Custom JS files -->
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>

</html>




