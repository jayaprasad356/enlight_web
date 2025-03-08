<?php

namespace App\Http\Controllers;

use App\Models\payment_screenshots;
use App\Models\PaymentScreenshots;
use App\Models\Users;
use App\Models\Transactions;
use Illuminate\Http\Request;

class PaymentScreenshotsControllers extends Controller
{
    // List all payment screenshots with optional filtering
    public function index(Request $request)
    {
        $status = $request->get('status'); 

        $payment_screenshots = payment_screenshots::with('users')
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('datetime', 'desc') 
            ->get();

        return view('payment_screenshots.index', compact('payment_screenshots'));
    }

    // Show the edit form in a modal
    public function edit($id)
    {
        $payment_screenshot = payment_screenshots::findOrFail($id);
        return view('payment_screenshots.edit', compact('payment_screenshot'));
    }

    public function update(Request $request, $id)
    {
        $payment_screenshot = payment_screenshots::findOrFail($id);
    
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
            'recharge' => 'nullable|numeric', // Allow positive and negative values
        ]);
    
        $payment_screenshot->status = $request->status;
        $payment_screenshot->save();
    
        if ($request->status == 1 && $request->has('recharge')) {
            $user = $payment_screenshot->users;
            $rechargeAmount = $request->recharge; // Can be positive or negative
    
            if ($user) {
                // Deduct or Add the recharge amount
                $user->recharge += $rechargeAmount;
                $user->save();
    
                // Create a transaction record
                Transactions::create([
                    'user_id' => $user->id,
                    'type' => 'recharge', // Log type based on amount
                    'amount' => $rechargeAmount,
                    'datetime' => now(),
                ]);
            }
        }
    
        return redirect()->route('payment_screenshots.index')->with('success', 'Payment Screenshot updated successfully.');
    }
    
}
