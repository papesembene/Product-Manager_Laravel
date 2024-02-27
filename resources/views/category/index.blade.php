@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Categoty  List</div>
        @if (session('store'))
            <alert class="alert alert-success"> {{session('store')}} </alert>
        @endif
        @if (session('update'))
            <alert class="alert alert-secondary"> {{session('update')}} </alert>
        @endif
        @if (session('delete'))
            <alert class="alert alert-danger"> {{session('delete')}} </alert>
        @endif
        <div class="card-body">
            @can('create-category')
                <a href="{{ route('category.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Category</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('category.show', $category->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                @can('edit-category')
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endcan

                                @can('delete-category')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Category?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Category Found!</strong>
                        </span>
                    </td>
                @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}

        </div>
    </div>
@endsection

