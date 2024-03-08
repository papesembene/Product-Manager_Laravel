@extends('layouts.app')

@section('content')
    <style>
        /* Style pour griser la page */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Opacité de l'arrière-plan gris */
            z-index: 9999; /* Placez au-dessus de tous les autres éléments */
        }

        /* Style pour le message de chargement */
        .loading-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10000; /* Placez au-dessus de l'arrière-plan gris */
        }

        /* Style pour le message de confirmation */
        .success-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10000; /* Placez au-dessus de l'arrière-plan gris */
        }
    </style>

    <!-- Row start -->
    <div class="row">
        <div class="float-end">
            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
        </div>
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
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->pivot->order_quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->pivot->order_quantity * $product->price }}</td>
                                        </tr>
                                        {{$full += $product->pivot->order_quantity * $product->price}}
                                    @endforeach
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                            <td>

                                                <h5 class="mt-4 text-primary">Full Amount</h5>
                                            </td>
                                            <td>
                                                <h5 class="mt-4 text-primary">
                                                    {{$full}}
                                                </h5>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                    <!-- Loader -->
                    <div id="loader" class="loading-overlay d-none">
                        <div class="loading-message">Téléchargement en cours...</div>
                    </div>

                    <!-- Message de confirmation -->
                    <div id="successMessage" class="success-message d-none">
                        Téléchargement réussi!
                    </div>

                    <!-- Row start -->
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="text-end">
                                <a href="{{ route('orderpdf.download', ['order_id' => $order->id]) }}" class="btn btn-primary" id="pdf-download-link">Download</a>
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

    <script>
        // Fonction pour masquer le message de chargement et afficher le message de confirmation
        function hideLoadingMessage() {
            document.getElementById('loader').classList.add('d-none');
            document.getElementById('successMessage').classList.remove('d-none');
            setTimeout(function() {
                document.getElementById('successMessage').classList.add('d-none');
            }, 3000); // Masquer le message après 2 secondes
        }

        // Événement déclenché lorsque le téléchargement est terminé
        document.getElementById('pdf-download-link').addEventListener('click', function() {
            document.getElementById('loader').classList.remove('d-none');
            document.getElementById('successMessage').classList.add('d-none');
            // Fonction pour masquer le message de chargement lorsque le téléchargement est terminé
            setTimeout(hideLoadingMessage, 5000); // Simulez un téléchargement de 3 secondes (à remplacer par la durée réelle du téléchargement)
        });
    </script>
@endsection
