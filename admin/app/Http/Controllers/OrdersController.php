<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;  
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user = Auth::user();
        $products = Products::all();
        $orders = Orders::with(['user', 'product'])->paginate(10); 

        return view('orders.index', compact('user', 'products', 'orders'));
    }

    public function edit($id)
    {
        $order = Orders::with('user', 'product')->findOrFail($id);
        $products = Products::all();
        $users = Users::all();  // Fetch all users
    
        return view('orders.edit', compact('order', 'products', 'users'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
            'live_tracking' => 'nullable|string|max:255',
        ]);

        $orders = Orders::findOrFail($id);

        $orders->update([
            'status' => $request->status,
            'live_tracking' => $request->live_tracking,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }
}
