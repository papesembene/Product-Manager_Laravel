@extends('layouts.app')

@section('content')
    <!-- Row start -->
    <div class="float-end">
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('orders.update',$order->id)}}" method="post">
                @csrf
                @method('PUT')
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
                                                        <option value="{{$customer->id}}"  {{ old('customer_id', $order->customer_id) === $customer->id ? 'selected' : '' }}>{{ $customer->firstname.' '.$customer->lastname }}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Form group end -->
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="dueDate" class="form-label">Address </label>
                                                <input type="text" id="customerAddress" readonly class="form-control" value="{{ old('address', $order->customer->address) }}">
                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Form group end -->
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="dueDate" class="form-label">Number </label>
                                                <input type="text" id="customerPhone" readonly class="form-control" value="{{ old('number', $order->customer->number) }}">
                                                @error('number')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="num" class="form-label">Order Date </label>
                                                <input type="date" id="date" readonly class="form-control" name="order_date" value="{{ old('order_date', $order->order_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <!-- Form group start -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status </label>
                                                <select  class="form-select  @error('status') is-invalid @enderror" name="status" id="status" >
                                                    <option value="Finished"  {{ old('status', $order->status) === 'Finished' ? 'selected' : '' }}>Finished</option>
                                                    <option value="Waiting"  {{ old('status', $order->status) === 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                            <select id="product1" class="form-select productSelect  @error('product-id') is-invalid @enderror" name="product1">
                                                <option>Select Product</option>
                                                @foreach(\App\Models\Product::all() as $prod)
                                                    <option value="{{$prod->id}}">{{$prod->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="m-0">
                                                <input type="number" value="{{ old('quantity') }}" id="quantity" name="quantity" readonly class="form-control quantity" >
                                            </div>
                                            <!-- Form group end -->
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="m-0">
                                                <input type="number" value="{{ old('price') }}" id="price" name="price" readonly class="form-control price">
                                            </div>
                                            <!-- Form group end -->
                                        </td>
                                        <td>
                                            <!-- Form group start -->
                                            <div class="input-group m-0">
                                                <input type="number" value="{{ old('order_quantity') }}" id="order_quantity" name="order_quantity" class="form-control order_quantity"  placeholder="Order Quantity">
                                                @error('order_quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                @foreach($order->products as $product)
                                    <tr>
                                        <td><input class="form-control" readonly type="text" value="{{ $product->name }}"  name="productNames[]"></td>
                                        <td><input class="form-control" readonly type="number" name="order_quantities[]" value="{{ $product->pivot->order_quantity }}"></td>
                                        <td><input class="form-control" readonly type="number" name="prices[]" value="{{ $product->price }}"></td>
                                        @php
                                            $tot = $product->price * $product->pivot->order_quantity ;
                                        @endphp
                                        <td>{{$tot}}</td>
                                        <td><input class="form-control" readonly type="number" name="amounts[]" value="{{$tot}} "></td>
                                        <td>
                                            <button class="btn btn-outline-danger" onclick="removeProductPreview(this)">Supprimer</button>
                                            <button class="btn btn-outline-success" onclick="editProductPreview(this)">Modifier</button>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-end">
                            <button type="submit" class="btn btn-light">Update Order</button>
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
                })
                .catch(function(error) {
                    console.error('Une erreur s\'est produite lors de la récupération des détails du client :', error);
                });
        });

        document.querySelectorAll('.productSelect').forEach(select => {
            select.addEventListener('change', function() {
                var productId = this.value;
                var row = this.closest('tr'); // Obtenez la ligne parente du champ de sélection actuel

                axios.get(`/orders/product/${productId}`)
                    .then(function(response) {
                        var productDetails = response.data;
                        // Mettre à jour les champs de prix et de quantité de la ligne parente avec les détails du produit
                        row.querySelector('.price').value = productDetails.price;
                        row.querySelector('.quantity').value = productDetails.quantity;
                    })
                    .catch(function(error) {
                        console.error('Une erreur s\'est produite lors de la récupération des détails du produit :', error);
                    });
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

        const order_quantity = document.getElementById('order_quantity');

        order_quantity.addEventListener('change', function() {
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');

            if (parseInt(this.value) > parseInt(quantityInput.value)) {
                this.value = quantityInput.value;
            } else if (parseInt(this.value) <= 0) {
                this.value = 1;
            }
        });

        function validateOrder() {
            const products = document.querySelectorAll('input[name="products[]"]');
            const quantities = document.querySelectorAll('input[name="quantities[]"]');
            const prices = document.querySelectorAll('input[name="prices[]"]');
            if (products.length === 0) {
                alert('Veuillez ajouter au moins un produit dans la commande');
            }
        }

        function addProductPreview() {
            const productName = document.getElementById('product1');
            const priceInput = document.getElementById('price');
            const stockInput = document.getElementById('quantity');
            const orderQuantityInput = document.getElementById('order_quantity');
            const tbody = document.getElementById('preview_body');
            const product = productName.options[productName.selectedIndex].text;
            const quantity = orderQuantityInput.value;
            const price = priceInput.value;

            if (!product || !quantity || !price ) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            let newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td><input class="form-control" readonly type="text" value="${productName.value}" name="products[]"></td>
                <td><input class="form-control" readonly type="text" value="${product}" name="productNames[]"></td>
                <td><input class="form-control" readonly type="number" name="order_quantities[]" value="${quantity}"></td>
                <td><input class="form-control" readonly type="number" name="prices[]" value="${price}"></td>
                <td><input class="form-control" readonly type="number" name="amounts[]" value="${price * quantity}"></td>
                <td>
                    <button class="btn btn-outline-danger" onclick="removeProductPreview(this)">Supprimer</button>
                    <button class="btn btn-outline-success" onclick="editProductPreview(this)">Modifier</button>
                </td>
            `;

            const products = document.querySelectorAll('input[name="products[]"]');
            let productExist = false;
            products.forEach(product => {
                if (product.value === productName.value) {
                    productExist = true;
                }
            });
            if (productExist) {
                alert('Product Already exists');
                return;
            }

            tbody.insertBefore(newRow, tbody.lastElementChild);

            document.getElementById('product1').value ='';
            document.getElementById('price').value = '';
            document.getElementById('order_quantity').value ='';
            document.getElementById('quantity').value = '';
        }

        function removeProductPreview(button) {
            let row = button.closest('tr');
            row.remove();
        }
        // Ajoutez un gestionnaire d'événements pour l'événement change sur les éléments de sélection de produit
        document.getElementById('product1').addEventListener('change', function() {
            var productId = this.value;

            // Envoyez une requête AJAX au serveur pour récupérer les détails du produit sélectionné
            axios.get(`/orders/product/${productId}`)
                .then(function(response) {
                    var productDetails = response.data;

                    // Mettez à jour les champs de prix et de quantité en stock dans votre formulaire avec les détails du produit récupérés
                    document.getElementById('price').value = productDetails.price;
                    document.getElementById('quantity').value = productDetails.quantity;
                })
                .catch(function(error) {
                    console.error('Une erreur s\'est produite lors de la récupération des détails du produit :', error);
                });
        });


        function editProductPreview(button) {
            let row = button.closest('tr');
            let cells = row.querySelectorAll('td');

            // Récupérer les valeurs des champs dans chaque cellule
            let productName = cells[0].querySelector('input').value;
            let orderQuantity = cells[1].querySelector('input').value;
            let price = cells[2].querySelector('input').value;

            // Mettre à jour les champs du formulaire avec les valeurs récupérées
            document.getElementById('product1').value = productName;
            document.getElementById('order_quantity').value = orderQuantity;
            document.getElementById('price').value = price;

            // Supprimer la ligne du tableau d'aperçu après récupération des valeurs
            row.remove();
        }

    </script>

@endsection
