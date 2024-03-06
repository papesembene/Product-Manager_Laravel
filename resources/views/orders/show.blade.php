@extends('layouts.app')

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-sm-3 col-12">
                            <h4>IT.SN VENTE</h4>
                        </div>
                        <div class="col-sm-9 col-12">
                            <div class="text-end">
                                <p class="m-0">Order Commande : <span class="text-danger">{{ $order->order_num }}</span></p>
                                <p class="m-0">Order Date : <span class="m-0">{{ $order->order_date }}</span></p>
                            </div>
                        </div>
                        <div class="col-12 mb-5"></div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row justify-content-between">
                        <div class="col-lg-6 col-12">
                            <h4 class="fw-semibold"> Customer Informations  :</h4>
                            <p class="m-0">
                                <b>FullName :</b> {{ $order->customer->lastname.' '.$order->customer->firstname }}<br />
                                <b> Address :</b>{{ $order->customer->adress }}<br />
                                <b>Number Of Call :</b> {{ $order->customer->number }}<br />
                            </p>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="text-end">
                                <span class="badge bg-warning">{{ $order->status }}</span>
                            </div>
                        </div>
                        <div class="col-12 mb-3"></div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                        <th>Montant</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $full = 0;
                                    @endphp
                                    @foreach ($order->product as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->pivot->order_quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->pivot->order_quantity * $product->price }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                            <td>

                                                <h5 class="mt-4 text-primary">Full Amount</h5>
                                            </td>
                                            <td>
                                                <h5 class="mt-4 text-primary">
                                                    {{$full += $product->pivot->order_quantity * $product->price}}
                                                </h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="text-end">
                                <button class="btn btn-light">Download</button>
                                <button class="btn btn-light ms-1">Print</button>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection
