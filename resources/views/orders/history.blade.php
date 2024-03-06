<!-- resources/views/order/history.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Order History</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orderHistory as $order)
                                <tr>
                                    <td>{{ $order->order_num }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No orders found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
