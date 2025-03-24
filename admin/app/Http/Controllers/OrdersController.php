<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;  
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    // Show all orders
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user = Auth::user();

        // Fetch all orders with related users and products
        $products = Products::all();
        $orders = Orders::with('user', 'product')->get();

        return view('orders.index', compact('user', 'products', 'orders'));
    }
}
