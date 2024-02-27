@extends('layouts.app')

@section('content')
    <form>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-2">
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="7" class="pt-3 pb-3">
                                                Customer
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Adress</th>
                                            <th>Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select id="customerSelect" class="form-select">
                                                    <option>Select Customer</option>
                                                    @foreach(\App\Models\Customer::all() as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->lastname}}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="m-0">
                                                    <input type="text" id="customerAddress" disabled class="form-control">
                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="m-0">
                                                    <input type="text" id="customerPhone" disabled class="form-control">
                                                </div>
                                                <!-- Form group end -->
                                            </td>




                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- Row end -->
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="7" class="pt-3 pb-3">
                                                Products
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th> Order Quantity</th>
                                            <th> Full Amounts </th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <!-- Form group start -->
                                                <select id="productSelect" class="form-select">
                                                    <option>Select Product</option>
                                                    @foreach(\App\Models\Product::all() as $prod)
                                                        <option value="{{$prod->id}}">{{$prod->name}}</option>
                                                    @endforeach
                                                </select>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="m-0">
                                                    <input type="number" id="quantity" disabled class="form-control">                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="m-0">
                                                    <input type="date" id="date" disabled class="form-control">
                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="input-group m-0">
                                                    <input type="number" id="price" disabled class="form-control">
                                                    <span class="input-group-text">FCFA</span>
                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="input-group m-0">
                                                    <input type="number" id="order_quantity"   class="form-control" placeholder="Order Quantity">
                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
                                                <!-- Form group start -->
                                                <div class="input-group m-0">
                                                    <input type="number" id="full_amount"   class="form-control" disabled>
                                                </div>
                                                <!-- Form group end -->
                                            </td>
                                            <td>
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
                                                <button class="btn btn-outline-primary text-nowrap">
                                                    Add New Row
                                                </button>
                                            </td>
                                            <td colspan="6">
                                                <div class="row justify-content-end">
                                                    <div class="col-auto">
                                                        <label class="col-form-label">Discount % of Total Amount</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control" placeholder="0%" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">&nbsp;</td>
                                            <td>
                                                <p class="m-0">Subtotal</p>
                                                <p class="m-0">Discount</p>
                                                <p class="m-0">VAT</p>
                                                <h5 class="mt-2 text-primary">Total USD</h5>
                                            </td>
                                            <td>
                                                <p class="m-0">$0.00</p>
                                                <p class="m-0">$0.00</p>
                                                <p class="m-0">$0.00</p>
                                                <h5 class="mt-2 text-primary">$0.00</h5>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <button class="btn btn-light">Save as Draft</button>
                                    <a href="invoice-list.html" class="btn btn-success ms-1">Create Invoice</a>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                </div>
            </div>
        </div>
    </form>

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

        document.getElementById('productSelect').addEventListener('change', function() {
            var productId = this.value;

            axios.get(`/orders/product/${productId}`)
                .then(function(response) {
                    var productDetails = response.data;

                    // Mettre à jour les champs d'adresse et de téléphone avec les détails du client
                    document.getElementById('price').value = productDetails.price;
                    document.getElementById('quantity').value = productDetails.quantity;
                    //document.getElementById('full_amount').value = document.getElementById('order_quantity').value * productDetails.price;

                })
                .catch(function(error) {
                    console.error('Une erreur s\'est produite lors de la récupération des détails du produit :', error);
                });
        });
    </script>




@endsection
