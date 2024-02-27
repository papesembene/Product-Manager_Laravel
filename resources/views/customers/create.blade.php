@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New Customer
                    </div>
                    <div class="float-end">
                        <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-end text-start">Firstname</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}">
                                @if ($errors->has('firstname'))
                                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end text-start">Lastname</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                                @if ($errors->has('lastname'))
                                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="adress" class="col-md-4 col-form-label text-md-end text-start">Adress</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" name="adress" value="{{ old('adress') }}">
                                @if ($errors->has('adress'))
                                    <span class="text-danger">{{ $errors->first('adress') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="number" class="col-md-4 col-form-label text-md-end text-start">Number Call</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}">
                                @if ($errors->has('number'))
                                    <span class="text-danger">{{ $errors->first('adress') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="genre" class="col-md-4 col-form-label text-md-end text-start">Sexe</label>
                            <div class="col-md-6">
                                <select class="form-control" name="genre">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                </select>
                                @if ($errors->has('genre'))
                                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <button type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="">Add Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

