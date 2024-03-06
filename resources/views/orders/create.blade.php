@extends('layouts.app')

@section('content')
    <!-- Row start -->
    <div class="float-end">
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('orders.store')}}" method="post">
                @csrf
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="create-invoice-wrapper">
                            <!-- Row start -->
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <!-- Row start -->
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <select id="customerSelect" class="form-select  @error('customer_id') is-invalid @enderror " name="customer_id">
                                                    <option>Select Customer</option>
                                                    @foreach(\App\Models\Customer::all() as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->lastname}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('customer_id'))
                                                    <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                                                @endif
                                            </div>
                                            <!-- Form group end -->
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="dueDate" class="form-label">Adress </label>
                                                <input type="text" id="customerAddress" disabled class="form-control">
                                                @if ($errors->has('adress'))
                                                    <span class="text-danger">{{ $errors->first('adress') }}</span>
                                                @endif
                                            </div>
                                            <!-- Form group end -->
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="dueDate" class="form-label">Number </label>
                                                <input type="text" id="customerPhone" disabled class="form-control">
                                                @if ($errors->has('number'))
                                                    <span class="text-danger">{{ $errors->first('number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="num" class="form-label">Order Date </label>
                                                <input type="date" id="date" readonly class="form-control" name="order_date" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status </label>
                                                <select  class="form-select  @error('status') is-invalid @enderror" name="status" >
                                                    <option value="Finished">Finished</option>
                                                    <option value="Waiting">Waiting</option>
                                                </select>

                                            </div>
                                        </div>

                                        <!-- Form group end -->
                                    </div>

                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <thead>
                                    <tr>
                                        <th colspan="7" class="pt-3 pb-3">
                                            Items/Products
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Order Quantity</th>
                                        <th colspan="3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_detail">
                                    <tr id="product">
                                        <td>
                                            <select id="productSelect" class="form-select  @error('product-id') is-invalid @enderror " name="products[]"  >
                                                <option>Select Product</option>
                                                @foreach(\App\Models\Product::all() as $prod)
                                                    <option value="{{$prod->id}}">{{$prod->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('products_id'))
                                                <span class="text-danger">{{ $errors->first('product_id') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="m-0">
                                                <input type="number" id="quantity" disabled class="form-control">
                                            </div>
                                            <!-- Form group end -->
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="m-0">
                                                <input type="number" id="price" disabled class="form-control">
                                            </div>
                                            <!-- Form group end -->
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="input-group m-0">
                                                <input type="number" id="order_quantity" name="quantities[]"  class="form-control" placeholder="Order Quantity">
                                                @if ($errors->has('order_quantity'))
                                                    <span class="text-danger">{{ $errors->first('order_quantity') }}</span>
                                                @endif
                                            </div>
                                            <!-- Form group end -->
                                        </td>

                                        <td colspan="3">
                                            <div class="d-inline-flex gap-3">
                                                <button class="btn btn-outline-danger">
                                                    <i class="icon-trash"></i>
                                                </button>
                                                <button class="btn btn-outline-success">
                                                    <i class="icon-edit"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-primary text-nowrap"  type="button"  id="add-product" onclick="addProductPreview()">
                                                Add Product
                                            </button>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="preview_table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Order Quantity</th>
                                    <th>Price</th>
                                    <th>Amounts</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="preview_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-end">
                            <button type="submit" class="btn btn-light">Validate Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Row end -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.getElementById('customerSelect').addEventListener('change', function() {
            var customerId = this.value;
            axios.get(`/orders/customer/${customerId}`)
                .then(function(response) {
                    var customerDetails = response.data;
                    // Mettre à jour les champs d'adresse et de téléphone avec les détails du client
                    document.getElementById('customerAddress').value = customerDetails.adress;
                    document.getElementById('customerPhone').value = customerDetails.number;
                    //console.log(data);
                })
                .catch(function(error) {
                    console.error('Une erreur s\'est produite lors de la récupération des détails du client :', error);
                });
        });

        document.getElementById('productSelect').addEventListener('change', function() {
            var productId = this.value;
            axios.get(`/orders/product/${productId}`)
                .then(function(response) {
                    var productDetails = response.data;
                    // Mettre à jour les champs de prix et de quantité avec les détails du produit
                    document.getElementById('price').value = productDetails.price;
                    document.getElementById('quantity').value = productDetails.quantity;
                })
                .catch(function(error) {
                    console.error('Une erreur s\'est produite lors de la récupération des détails du produit :', error);
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('date');
            // Créer une nouvelle date avec la date d'aujourd'hui
            var today = new Date();

            // Obtenez la date au format YYYY-MM-DD (format attendu par le champ date)
            var formattedDate = today.toISOString().slice(0, 10);

            // Définissez la valeur du champ sur la date d'aujourd'hui
            dateInput.value = formattedDate;
        });
        function addProductPreview() {
            // Récupérer les valeurs des champs
            let productName = document.getElementById('productSelect').value;
            let price = document.getElementById('price').value;
            let orderQuantity = document.getElementById('order_quantity').value;

            // Vérifier si les champs sont vides
            if (!productName ||  !price || !orderQuantity) {
                alert("Veuillez remplir tous les champs pour ajouter un produit.");
                return; // Arrêter la fonction si un champ est vide
            }

            // Créer une nouvelle ligne pour le produit dans le tableau d'aperçu
            let newRow = document.createElement('tr');

            // Remplir la nouvelle ligne avec les valeurs des champs
            newRow.innerHTML = `
        <td>${productName}</td>
        <td>${orderQuantity}</td>
        <td>${price}</td>
        <td>${orderQuantity * price}</td>
        <td>
            <button class="btn btn-outline-danger" onclick="removeProductPreview(this)">Supprimer</button>
            <button class="btn btn-outline-success" onclick="editProductPreview(this)">Modifier</button>
        </td>
    `;

            // Ajouter la nouvelle ligne au tableau d'aperçu
            document.getElementById('preview_body').appendChild(newRow);
            console.log(orderQuantity);
            // Vider les champs du formulaire
            document.getElementById('productSelect').value = '';
            document.getElementById('quantity').value = '';
            document.getElementById('price').value = '';
            document.getElementById('order_quantity').value = '';
        }

        // Fonction pour supprimer un produit du tableau d'aperçu
        function removeProductPreview(button) {
            // Sélectionner la ligne parente (tr) du bouton
            let row = button.closest('tr');
            // Supprimer la ligne du tableau d'aperçu
            row.remove();
        }
        // Fonction pour modifier un produit dans le tableau d'aperçu
        function editProductPreview(button) {
            // Sélectionner la ligne parente (tr) du bouton
            let row = button.closest('tr');
            // Récupérer les cellules de la ligne
            let cells = row.querySelectorAll('td');
            // Extraire les données du produit de chaque cellule
            let productName = cells[0].innerText;
            let quantity = cells[1].innerText;
            let price = cells[2].innerText;
            let orderQuantity = cells[3].innerText;
            // Mettre à jour les valeurs des champs dans le formulaire d'ajout de produit
            document.getElementById('productSelect').value = productName;
            document.getElementById('quantity').value = quantity;
            document.getElementById('price').value = price;
            document.getElementById('order_quantity').value = orderQuantity;
            // Supprimer la ligne du tableau d'aperçu
            row.remove();
        }
    </script>

@endsection


