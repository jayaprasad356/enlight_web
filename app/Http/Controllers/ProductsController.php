<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;

class ProductsController extends Controller
{
    // Show Products List
    public function index()
    {
        $user_id = Session::get('user_id');
        $user = Users::find($user_id);

        // Wallet balance
        $purchase_wallet = $user ? $user->purchase_wallet : 0;

        // Count Level 1 referrals
        $referral_count = Users::where('level_1_refer', $user->refer_code)
            ->where('status', 1)
            ->count();

        $products = Products::all();

        return view('products.index', compact('products', 'purchase_wallet', 'referral_count'));
    }

    // Handle Purchase Request
    public function purchase(Request $request)
    {
        $user_id = Session::get('user_id');
        $user = Users::find($user_id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $product_id = $request->product_id;
        $price = $request->price;
        $address = $request->address;

        // Prevent user_id 1 from purchasing the same product multiple times
        if ($user_id == 1 && Orders::where('user_id', 1)->where('product_id', $product_id)->exists()) {
            return response()->json([
                'success' => false, 
                'message' => 'You have already purchased this product.'
            ], 400);
        }

        // Check wallet balance
        if ($user->purchase_wallet < $price) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance.'], 400);
        }

        // Deduct balance
        $user->purchase_wallet -= $price;
        $user->save();

        // Store the order
        Orders::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'price' => $price,
            'address' => $address,
            'datetime' => now(),
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Order placed successfully. Redirecting...'
        ]);
    }
}
