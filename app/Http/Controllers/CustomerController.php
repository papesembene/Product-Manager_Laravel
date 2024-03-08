<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\CustomerExport;
use App\Models\Product;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-customer|edit-customer|delete-customer', ['only' => ['index','show']]);
        $this->middleware('permission:create-customer', ['only' => ['create','store']]);
        $this->middleware('permission:edit-customer', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-customer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create',[
            'customers'=>Customer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->all());
        return redirect()->route('customers.index')
            ->with('store','New Customer is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('customers.index')
            ->with('update','Customer is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('delete','Customer is deleted successfully.');
    }
    public function customerOrderHistory($customerId)
    {
        // Récupérer le client
        $customer = Customer::findOrFail($customerId);

        // Récupérer l'historique des commandes pour ce client
        $orderHistory = $customer->Orders()->with('details')->get();

        // Retourner la vue avec l'historique des commandes
        return view('orders.history', compact('orderHistory'));
    }
    public function downloadCustomer()
    {
        $customer = Customer::all();
        // Charger la vue avec l'instance de modèle Customer
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('customers.customerpdf', compact('customer'));
        return $pdf->download('CustomerList.pdf');
    }
    public function downloadExcel()
    {
        return Excel::download(new CustomerExport(), 'customersList.xlsx');
    }

}
