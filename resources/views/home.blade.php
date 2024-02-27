@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-9 col-10">
            <!-- App header actions start -->
            <div class="header-actions d-flex align-items-center justify-content-end">

                <!-- Search container start -->
                <div class="search-container d-none d-lg-block">
                    <input type="text" class="form-control" placeholder="Search" />
                    <i class="icon-search"></i>
                </div>
                <!-- Search container end -->
                <!-- Toggle Menu starts -->
                <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                    <i class="icon-menu"></i>
                </button>
                <!-- Toggle Menu ends -->

            </div>
            <!-- App header actions end -->

        </div>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <div class="col-md-9 col-10">
                        <!-- App header actions start -->
                        <div class="header-actions d-flex align-items-center justify-content-end">

                            <!-- Search container start -->
                            <div class="search-container d-none d-lg-block">
                                <input type="text" class="form-control" placeholder="Search" />
                                <i class="icon-search"></i>
                            </div>
                            <!-- Search container end -->



                            <!-- Toggle Menu starts -->
                            <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                                <i class="icon-menu"></i>
                            </button>
                            <!-- Toggle Menu ends -->

                        </div>
                        <!-- App header actions end -->

                    </div>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        IT.SN VENTE
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
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
                                @canany(['create-user', 'edit-user', 'delete-user'])
                                    <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                                @endcanany
                                @canany(['create-product', 'edit-product', 'delete-product'])
                                    <li><a class="nav-link" href="{{ route('products.index') }}">Manage Products</a></li>
                                @endcanany
                                @canany(['create-category', 'edit-category', 'delete-category'])
                                    <li><a class="nav-link" href="{{ route('category.index') }}">Manage Category</a></li>
                                @endcanany
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-12">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @endif




                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
