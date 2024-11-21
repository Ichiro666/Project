<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        return Inertia::render('Admin/Customers/IndexCust', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Form untuk membuat customer baru
        return Inertia::render('Admin/Customers/CreateCust');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dan simpan data customer baru
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'category' => 'required|string|max:255',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'category' => $request->category,
        ]);

        return redirect()->route('/customers')->with('message', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Admin/Customers/ShowCust', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Admin/Customers/EditCust', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validasi dan update data customer
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'category' => 'required|string|max:255',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'category' => $request->category,
        ]);

        return redirect()->route('/customers')->with('message', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('message', 'Customer deleted successfully.');
    }
}
