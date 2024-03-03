<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // Nombre total de clients
        $totalCustomers = Customer::count();

        // Nombre de clients par sexe (par exemple, supposons que vous ayez un champ 'gender' dans votre table 'customers')
        $maleCustomers = Customer::where('genre', 'Male')->count();
        $femaleCustomers = Customer::where('genre', 'Female')->count();

        // Nombre total de produits
        $totalProducts = Product::count();

        return view('dashboard.index', compact('totalCustomers', 'maleCustomers', 'femaleCustomers', 'totalProducts'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
