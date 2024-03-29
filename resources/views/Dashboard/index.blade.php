@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row gx-2">
        <div class="col-sm-4 col-12">
            <div class="card mb-2">
                <div class="card-img">
                    <img src="assets/images/products/product10.jpg" background-size:="" cover;=""
                         class="card-img-top img-fluid" alt="Admin" />
                </div>
                <div class="card-body">
                    <p class="mb-4">
                        number of Customers : {{ $totalCustomers }}
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="card mb-2">
                <div class="card-img">
                    <img src="assets/images/products/product8.jpg" background-size:="" cover;=""
                         class="card-img-top img-fluid" alt="Admin" />
                </div>

                <div class="card-body">
                    <p class="mb-4">
                        All Products : {{ $totalProducts }}
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="card mb-2">
                <div class="card-img">
                    <img src="assets/images/products/product4.jpg" background-size:="" cover;=""
                         class="card-img-top img-fluid" alt="Admin" />
                </div>
                <div class="card-body">

                    <p class="mb-3">
                        Male: {{ $maleCustomers }}, Female: {{ $femaleCustomers }}
                    </p>

                </div>
            </div>
        </div>
    </div>


    </div>

@endsection
