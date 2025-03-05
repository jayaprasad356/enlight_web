<?php

namespace App\Http\Controllers;

use App\Models\PaymentScreenshots;
use App\Models\Users;
use App\Models\Transactions;
use App\Models\payment_screenshots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PaymentScreenshotsControllers extends Controller
{
    public function index(Request $request)
    {
        // Get the filters from the query string
        $status = $request->get('status'); // Default to Pending

        // Query to fetch withdrawals based on the filters
        $payment_screenshots = payment_screenshots::with('users')
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
         
            ->when($request->get('search'), function ($query, $search) {
                $query->where('transaction_id', 'like', '%' . $search . '%')
                      ->orWhereHas('users', function ($query) use ($search) {
                          $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('mobile', 'like', '%' . $search . '%');
                      });
            })
            ->orderBy('datetime', 'desc') // Order by latest data
            ->get();

        // Return the view with the filtered withdrawals
        return view('payment_screenshots.index', compact('payment_screenshots'));
    }
    public function update(Request $request, $id)
    {
        $payment_screenshot = payment_screenshots::findOrFail($id);

        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        $payment_screenshot->status = $request->status;
        $payment_screenshot->save();

        return redirect()->route('payment_screenshots.index')->with('success', 'Payment Screenshot updated successfully.');
    }

    
    public function bulkUpdateStatus(Request $request)
    {
        // Validate the request to ensure work IDs and status are provided
        $request->validate([
            'payment_screenshots_ids' => 'required|array',
            'payment_screenshots_ids.*' => 'exists:payment_screenshots,id',
            'new_status' => 'required|integer|in:1,2', // Only allow 1 (Paid) or 2 (Cancelled)
        ]);
    
        $status = (int) $request->new_status;
    
        // Fetch works with user details
        $payment_screenshots_ids = $request->get('payment_screenshots_ids', []);
        $payment_screenshots = payment_screenshots::whereIn('id', $payment_screenshots_ids)->with('users')->get();
    
        foreach ($payment_screenshots as $payment_screenshot) {
            if (($payment_screenshot->status == 2 && $status == 1)) {
                return redirect()->route('payment_screenshots.index')->with('success', 'Cannot Change into Verified Payment Screenshot that is already marked as Cancelled.');
            }
            $user = $payment_screenshot->users;
    
            if ($user && $status === 1) { // Check only if verifying (setting status to 1)
                // Check if the user has already been verified today
                $alreadyVerified = DB::table('transactions')
                    ->where('user_id', $user->id)
                    ->where('type', 'payment_screenshot')
                    ->whereDate('datetime', now()->toDateString())
                    ->exists();
    
                if ($alreadyVerified) {
                    return redirect()->route('payment_screenshots.index')->with('error', 'User has already been verified today.');
                }
            }
        }
    
        // Update the status of the selected works
        payment_screenshots::whereIn('id', $request->payment_screenshots_ids)->update(['status' => $status]);
    
        if ($status === 1) {
          
            $amount = 299; // Default to 0 if not found
    
            foreach ($payment_screenshots as $payment_screenshot) {
                $user = $payment_screenshot->users;
    
                if ($user) { // Ensure user exists
                    // Insert into transactions table
                    DB::table('transactions')->insert([
                        'user_id' => $user->id,
                        'amount' => $amount,
                        'type' => 'payment_screenshot',
                        'datetime' => now(),
                    ]);
    
                    // Update user's whatsapp_status_income and refer_income fields
                    $user->increment('balance', $amount);
                }
            }
        }
    
        // Return the response with a success message
        return redirect()->route('payment_screenshots.index')->with('success', 'Payment Screenshot status updated successfully.');
    }

    
}
