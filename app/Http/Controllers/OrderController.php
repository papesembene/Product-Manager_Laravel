<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index', [
                  'products' => Product::all(),
                   'customers'=>Customer::all()
               ]);
    }
    public function getCustomerDetails($id)
    {
        //récupérer les détails du client en fonction de l'ID
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'adress' => $customer->adress,
            'number' => $customer->number
        ]);
    }
    public function getProductDetails($id)
    {
        //récupérer les détails du produit en fonction de l'ID
        $prod = Product::find($id);

        if (!$prod) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'price' => $prod->price,
            'quantity'=>$prod->quantity,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
