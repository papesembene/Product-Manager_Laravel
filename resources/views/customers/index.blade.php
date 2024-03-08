@extends('layouts.app')

@section('content')
    <!-- Dans votre vue où vous affichez les détails d'un client -->
    <div class="card">
        <div class="card-header">Customers List</div>
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
            @can('create-customer')
                <a href="{{ route('customers.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Customer</a>
            @endcan
                <a href="{{ route('customer.download') }}" class="btn btn-light btn-sm my-2" id="pdf-download-link"> PDF </a>
                <a href="{{ route('customer.downloadexcel') }}" class="btn btn-outline-success btn-sm my-2"> EXCEL </a>
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Fistname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Adress</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $customer->firstname }}</td>
                        <td>{{ $customer->lastname }}</td>
                        <td>{{ $customer->adress }}</td>
                        <td>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('orders.history', ['customer_id' => $customer->id]) }}" class="btn btn-outline-light btn-sm my-2">Historique des commandes</a>
                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                @can('edit-customer')
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endcan

                                @can('delete-customer')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this customer?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Customer Found!</strong>
                        </span>
                    </td>
                @endforelse
                </tbody>
            </table>

            {{ $customers->links() }}

        </div>
        <!-- Loader -->
        <div id="loader" class="loading-overlay d-none">
            <div class="loading-message">Téléchargement en cours...</div>
        </div>

        <!-- Message de confirmation -->
        <div id="successMessage" class="success-message d-none">
            Téléchargement réussi!
        </div>
    </div>
    <script>
        // Fonction pour masquer le message de chargement et afficher le message de confirmation
        function hideLoadingMessage() {
            document.getElementById('loader').classList.add('d-none');
            document.getElementById('successMessage').classList.remove('d-none');
            setTimeout(function() {
                document.getElementById('successMessage').classList.add('d-none');
            }, 3000); // Masquer le message après 3 secondes
        }

        // Événement déclenché lorsque le téléchargement est terminé
        document.getElementById('pdf-download-link').addEventListener('click', function() {
            document.getElementById('loader').classList.remove('d-none');
            document.getElementById('successMessage').classList.add('d-none');
            // Fonction pour masquer le message de chargement lorsque le téléchargement est terminé
            setTimeout(hideLoadingMessage, 5000); // Simulez un téléchargement de 5 secondes (à remplacer par la durée réelle du téléchargement)
        });
    </script>
@endsection
