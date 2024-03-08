@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Orders List</div>
        @if (session('success'))
            <alert class="alert alert-success"> {{session('success')}} </alert>
        @endif
        @if (session('update'))
            <alert class="alert alert-secondary"> {{session('update')}} </alert>
        @endif
        @if (session('delete'))
            <alert class="alert alert-danger"> {{session('delete')}} </alert>
        @endif
        <div class="card-body">
            @can('create-customer')
                <a href="{{ route('orders.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Order</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Order Num</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->order_num }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->status }}</td>

                        <td>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                @can('edit-order')

                                        <a {{$order->status =='Finished'?'hidden':''}} href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                @endcan

                                @can('delete-order')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this order?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Orders Found!</strong>
                        </span>
                    </td>
                @endforelse
                </tbody>
            </table>

            {{$orders->links()}}

        </div>
    </div>
@endsection
