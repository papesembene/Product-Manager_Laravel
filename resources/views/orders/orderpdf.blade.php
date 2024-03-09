<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
        h4 {
            color: #333;
        }
        p {
            margin: 0;
        }
        th, td {
            text-align: center;
        }
    </style>
</head>
<body>
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
                        <div class="text-right">
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
                        <h4 class="fw-semibold"> Customer Informations :</h4>
                        <p class="m-0">
                            <b>Full Name:</b> {{ $order->customer->lastname.' '.$order->customer->firstname }}<br>
                            <b>Address:</b> {{ $order->customer->address }}<br>
                            <b>Number Of Call:</b> {{ $order->customer->number }}<br>
                        </p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="text-right">
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
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
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
                                        @php
                                            $full += $product->pivot->order_quantity * $product->price
                                         @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        <h5 class="mt-4 text-primary">Full Amount: {{$full}}</h5>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Row end -->

            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
