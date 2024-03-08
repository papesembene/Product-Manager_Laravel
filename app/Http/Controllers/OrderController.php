<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function Laravel\Prompts\alert;
use PDF;

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
    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required',
            'status' => 'required',
            'products' => 'required|array',
            'order_quantities' => 'required|array|min:1',
        ]);

        $order = \App\Models\Order::create([
            'customer_id' => $request->input('customer_id'),
            'status' => $request->input('status'),
            'order_num' => "COM" . rand(100, 1000),
            'order_date' => $request->input('order_date'),
        ]);

        $Status = $request->input('status');
        $statutValidate = $Status === 'Finished';

        // Synchroniser les produits et les quantités
        foreach ($request->input('products') as $key => $product) {
            $order->products()->attach($product, ['order_quantity' => $request->input('order_quantities')[$key]]);

            // Mise à jour du stock si la commande est validée
            if ($statutValidate) {
                $productUpdate = \App\Models\Product::find($product);
                if ($productUpdate) {
                    // Mise à jour du stock
                    $newStock = $productUpdate->stock - $request->input('order_quantities')[$key];
                    $productUpdate->update(['stock' => $newStock]);
                }
            }
        }

        return redirect()->route('orders.index')->with('success', "Order $order->order_num add with success");
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
    public function update(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required',
            'status' => 'required',
            'products' => 'required|array',
            'order_quantities' => 'required|array',
        ]);

        $order = new Order();
        $order->customer_id = $request->input('customer_id');
        $order->order_num = "COM" . rand(100, 1000);
        $order->order_date = $request->input('order_date');
        $order->status = $request->input('status');
        $order->save();
        $Status = $request->input('status');
        $statutValidate = $Status === 'Finished';

        // Synchroniser les produits et les quantités
        foreach ($request->input('products') as $key => $product) {
            $order->products()->syncWithPivotValues($product['product_id'], ['order_quantity' => $product['order_quantity']]);
            // Mise à jour du stock si la commande est validée
            if ($statutValidate) {
                $productUpdate = \App\Models\Product::find($product);
                if ($productUpdate) {
                    // Mise à jour du stock
                    $newStock = $productUpdate->stock - $request->input('order_quantities')[$key];
                    $productUpdate->update(['stock' => $newStock]);
                }
            }
        }

        return redirect()->route('orders.index')->with('update', 'Commande update avec succès.');

    }




    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Chargement de la relation 'products' avec l'instance de modèle $order
        $order->with('product');

        return view('orders.show', [
            'order' => $order
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => $order
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Récupérer la commande
        $order = Order::findOrFail($id);

        // Restaurer le stock pour chaque produit dans la commande
        /*foreach ($order->Order_details as $orderDetail) {
            if ($orderDetail->Products){
                $product = $orderDetail->Products;
                $product->quantity += $orderDetail->order_quantity;
                $product->save();
            }

        }*/


        // Supprimer la commande
        $order->delete();

        // Rediriger avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès et le stock a été restauré.');
    }



    public function downloadPdf($order_id)
    {
        // Récupérer l'instance de modèle Order
        $order = \App\Models\Order::with('product')->findOrFail($order_id);

        // Charger la vue avec l'instance de modèle Order
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('orders.orderpdf', compact('order'));

        return $pdf->download('CustomerOrder.pdf');
    }




}
