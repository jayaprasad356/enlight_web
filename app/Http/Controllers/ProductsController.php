<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Users; // Import the User model
use App\Models\Products; // Import the Product model

class ProductsController extends Controller
{
    // Show Products List Page
    public function index()
    {
         // Get user_id from session
         $user_id = Session::get('user_id');
    
         // Fetch the user and their balance from the database
         $user = Users::find($user_id);
     
         // If user is found, get their balance, else default to 0
         $balance = $user ? $user->balance : 0;
        // Fetch products from the database
        $products = Products::all();

        return view('my_products.index', compact('products', 'balance'));
    }
}
