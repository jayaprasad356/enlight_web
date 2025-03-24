<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;  

class OrdersController extends Controller
{
    // Show only the logged-in user's orders
    public function index()
    {
        // Get the current logged-in user's ID from the session
        $user_id = Session::get('user_id');
        $user = Users::find($user_id);

        // Fetch products (if you want to display them separately)
        $products = Products::all();

        // Fetch orders for the logged-in user only
        $orders = Orders::with('users', 'products')
                        ->where('user_id', $user_id)   // Filter by session user_id
                        ->get();

        // Check if user exists and display orders
        if ($user) {
            return view('orders.index', compact('user', 'products', 'orders'));
        } else {
            return redirect()->route('mobile.login')->with('error', 'User not found');
        }
    }
}
