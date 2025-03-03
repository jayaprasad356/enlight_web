<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products; // Import the Product model

class ProductsController extends Controller
{
    // Show Products List Page
    public function index()
    {
        // Fetch products from the database
        $products = Products::all();

        return view('my_products.index', compact('products'));
    }
}
