@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Customers Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end text-start"><strong>Firstname:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $customer->firstname }}
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end text-start"><strong>Lastname:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $customer->lastname }}
                        </div>
                    </div>
                    <div class="row">
                        <label for="adress" class="col-md-4 col-form-label text-md-end text-start"><strong>Adress:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $customer->adress }}
                        </div>
                    </div>
                    <div class="row">
                        <label for="number" class="col-md-4 col-form-label text-md-end text-start"><strong>Number Call:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $customer->number }}
                        </div>
                    </div>
                    <div class="row">
                        <label for="genre" class="col-md-4 col-form-label text-md-end text-start"><strong>Sexe:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $customer->genre }}
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

@endsection
