<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // List all avatars
    public function index(Request $request)
    {
        $search = $request->get('search'); // Get the search term from the request
        
        // If there's a search term, filter by gender or gift icon name
        if ($search) {
            $products = Products::where('coins', 'like', '%' . $search . '%')
                             ->orWhere('gift_icon', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc') // Order by latest created
                             ->get();
        } else {
            // Otherwise, fetch all avatars and order by latest created
            $products = Products::orderBy('created_at', 'desc')->get();
        }

        return view('products.index', compact('products'));
    }

    // Show the create form
    public function create()
    {
        return view('products.create'); // Return create view
    }

    // Store the new product
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048', // Added avif to the mimes rule
            'name' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'offer' => 'required|numeric',
        ], [
            'image.required' => 'A product image is required.',
            'image.image' => 'The uploaded file must be a valid image.',
            'image.mimes' => 'The image must be in jpeg, png, jpg, gif, or avif format.',
            'image.max' => 'The image size must be less than 2MB.',
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',
            'amount.required' => 'The product amount is required.',
            'amount.numeric' => 'The product amount must be a number.',
            'offer.required' => 'The product offer is required.',
            'offer.numeric' => 'The product offer must be a number.',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        // Create the product record
        $products = new Products();
        $products->image = $imagePath;
        $products->name = $request->name;
        $products->description = $request->description;
        $products->amount = $request->amount;
        $products->offer = $request->offer;
        $products->save();

        return redirect()->route('products.index')->with('success', 'Product successfully created.');
    }

    // Show the edit form
    public function edit($id)
    {
        $products = Products::findOrFail($id);

        // Check if the avatar exists (no user ownership validation)
        return view('products.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = Products::findOrFail($id);
    
        // Validate input
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif|max:2048',
            'name' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'offer' => 'required|numeric',
        ], [
            'image.image' => 'The uploaded file must be a valid image.',
            'image.mimes' => 'The image must be in jpeg, png, jpg, gif, or avif format.',
            'image.max' => 'The image size must be less than 2MB.',
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',
            'amount.required' => 'The product amount is required.',
            'amount.numeric' => 'The product amount must be a number.',
            'offer.required' => 'The product offer is required.',
            'offer.numeric' => 'The product offer must be a number.',
        ]);
    
        // Update image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($products->image && Storage::disk('public')->exists($products->image)) {
                Storage::disk('public')->delete($products->image);
            }
            $products->image = $request->file('image')->store('products', 'public');
        }
    
        // Update other fields
        $products->name = $request->name;
        $products->description = $request->description;
        $products->amount = $request->amount;
        $products->offer = $request->offer;
        
        // Save changes
        $products->save();
    
        return redirect()->route('products.index')->with('success', 'Product successfully updated.');
    }
    

    // Delete an avatar
    public function destroy($id)
    {
        $products = Products::findOrFail($id);

        // Delete the gift icon from storage
        if ($products->image && Storage::disk('public')->exists($products->image)) {
            Storage::disk('public')->delete($products->image);
        }

        $products->delete();

        return redirect()->route('products.index')->with('success', 'products successfully deleted.');
    }
}
