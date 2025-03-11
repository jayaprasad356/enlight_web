<?php

namespace App\Http\Controllers;

use App\Models\payment_screenshots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentScreenshotsControllers extends Controller
{
    // List all avatars
    public function index(Request $request)
{
    $search = $request->get('search'); // Get the search term from the request
    $userId = session('user_id'); // Get the currently logged-in user ID

    // Ensure we only fetch screenshots for the logged-in user
    if ($search) {
        $payment_screenshots = payment_screenshots::where('user_id', $userId)
            ->where(function ($query) use ($search) {
                $query->where('coins', 'like', '%' . $search . '%')
                      ->orWhere('gift_icon', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $payment_screenshots = payment_screenshots::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    return view('payment_screenshots.index', compact('payment_screenshots'));
}


    // Show the create form
    public function create()
    {
        return view('payment_screenshots.create'); // Return create view
    }

    // Store the new avatar
    public function store(Request $request)
    {
        $request->validate([
            'screenshots' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048', // Added avif to the mimes rule
        ], [
            'screenshots.required' => 'A gift icon file is required.',
            'screenshots.image' => 'The uploaded file must be a valid image.',
            'screenshots.mimes' => 'The screenshots must be in jpeg, png, jpg, gif, or avif format.',
            'screenshots.max' => 'The screenshots size must be less than 2MB.',
        ]);        
        $screenshotsIconPath = $request->file('screenshots')->store('payment_screenshots', 'public');

        // Create the avatar record
        $payment_screenshots = new payment_screenshots();
        $payment_screenshots->screenshots = $screenshotsIconPath;
        $payment_screenshots->user_id = session('user_id'); // Use user_id from session
        $payment_screenshots->datetime = now(); // Set current datetime
        $payment_screenshots->save();

        return redirect()->route('payment_screenshots.index')->with('success', 'payment_screenshots successfully created.');
    }

    // Show the edit form
    // public function edit($id)
    // {
    //     $payment_screenshots = payment_screenshots::findOrFail($id);

    //     // Check if the avatar exists (no user ownership validation)
    //     return view('payment_screenshots.edit', compact('payment_screenshots'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $payment_screenshots = payment_screenshots::findOrFail($id);
    
    //     // Validate input (removed 'gender' field as it's not in your form)
    //     $request->validate([
    //         'screenshots' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif|max:2048',
    //     ], [
    //         'screenshots.image' => 'The uploaded file must be a valid image.',
    //         'screenshots.mimes' => 'The gift icon must be in jpeg, png, jpg, gif, or avif format.',
    //         'screenshots.max' => 'The gift icon size must be less than 2MB.',
    //     ]);
    
    //     // Update gift icon if a new one is uploaded
    //     if ($request->hasFile('screenshots')) {
    //         // Delete old image
    //         if ($payment_screenshots->screenshots && Storage::disk('public')->exists($payment_screenshots->screenshots)) {
    //             Storage::disk('public')->delete($payment_screenshots->screenshots);
    //         }
    //         $payment_screenshots->screenshots = $request->file('screenshots')->store('payment_screenshots', 'public');
    //     }
    
    //     // Update coins
    //     $payment_screenshots->datetime;
        
    //     // Save changes
    //     $payment_screenshots->save();
    
    //     return redirect()->route('payment_screenshots.index')->with('success', 'Payment Screenshot successfully updated.');
    // }
    

    // Delete an avatar
    // public function destroy($id)
    // {
    //     $payment_screenshots = payment_screenshots::findOrFail($id);

    //     // Delete the gift icon from storage
    //     if ($payment_screenshots->gift_icon && Storage::disk('public')->exists($payment_screenshots->gift_icon)) {
    //         Storage::disk('public')->delete($payment_screenshots->gift_icon);
    //     }

    //     $payment_screenshots->delete();

    //     return redirect()->route('payment_screenshots.index')->with('success', 'payment_screenshots successfully deleted.');
    // }
}
