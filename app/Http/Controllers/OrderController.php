<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index', [
                  'orders' => Order::latest()->paginate(5),
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
            'number' => $customer->number,



        ]);
    }

    public function getProductDetails($id)
    {
        //récupérer les détails du produit en fonction de l'ID
        $prod = Product::find($id);

        if (!$prod) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        //$currentDate = Carbon::createFromFormat('d/m/Y', $prod->Orders->date)->format('Y-m-d');
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
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation  data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.order_quantity' => 'required|integer|min:1',
        ]);

        // Vérifier la disponibilité en stock pour chaque produit demandé
        foreach ($validatedData['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            if ($product->quantity < $productData['order_quantity']) {
                return back()->withError('La quantité demandée n\'est pas disponible en stock pour le produit '.$product->name);
            }
        }

        // Créer la commande
        $order = Order::create([
            'customer_id' => $validatedData['customer_id'],
            'order_num' => "COM" . rand(100, 1000),
            'order_date' => $validatedData['order_date'],
        ]);

        // Créer les détails de la commande pour chaque produit
        foreach ($validatedData['products'] as $productData) {
            $order->Order_details()->create([
                'order_quantity' => $productData['order_quantity'],
                'product_id' => $productData['product_id'],
            ]);

            // Mettre à jour la quantité en stock du produit
            $product = Product::find($productData['product_id']);
            $product->quantity -= $productData['order_quantity'];
            $product->save();
        }

        // Rediriger avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande ajoutée avec succès.');
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
