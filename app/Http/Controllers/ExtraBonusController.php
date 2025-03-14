<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Transactions;
use Illuminate\Support\Facades\DB;

class ExtraBonusController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');

        if (!$user_id) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Get the logged-in user's refer_code
        $user = Users::find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $refer_code = $user->refer_code;

        // Count referrals for each level
        $referralCounts = [
            1 => Users::where('level_1_refer', $refer_code)->where('status', 1)->count(),
            2 => Users::where('level_2_refer', $refer_code)->where('status', 1)->count(),
            3 => Users::where('level_3_refer', $refer_code)->where('status', 1)->count(),
            4 => Users::where('level_4_refer', $refer_code)->where('status', 1)->count(),
        ];

        return view('extra_bonus.index', compact('user_id', 'referralCounts'));
    }

    public function claim($level)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return redirect()->back()->with('error', 'User not logged in.');
        }
    
        $user = Users::find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        // Bonus levels data
        $levels = [
            1 => ['refers' => 10, 'bonus' => 1000, 'type' => 'level_1_claim'],
            2 => ['refers' => 30, 'bonus' => 2000, 'type' => 'level_2_claim'],
            3 => ['refers' => 90, 'bonus' => 3000, 'type' => 'level_3_claim'],
            4 => ['refers' => 270, 'bonus' => 5000, 'type' => 'level_4_claim'],
        ];
    
        // Validate if level exists
        if (!isset($levels[$level])) {
            return redirect()->back()->with('error', 'Invalid level.');
        }
    
        $requiredRefers = $levels[$level]['refers'];
        $bonusAmount = $levels[$level]['bonus'];
        $claimType = $levels[$level]['type'];
    
        $referralCount = Users::where("level_{$level}_refer", $user->refer_code)
        ->where('status', 1) // Only count active referrals
        ->count();
    
        // Check if user has enough referrals
        if ($referralCount < $requiredRefers) {
            return redirect()->back()->with('error', 'You do not have enough referrals for this level.');
        }
    
        // Check if the user has already claimed this level bonus
        $alreadyClaimed = Transactions::where('user_id', $user->id)
            ->where('type', $claimType)
            ->exists();
    
        if ($alreadyClaimed) {
            return redirect()->back()->with('error', "You have already claimed the bonus for Level $level.");
        }
    
        // Process the claim
        DB::beginTransaction();
        try {
            // Add bonus to level income wallet
            $user->balance += $bonusAmount;
            $user->save();
    
            // Insert transaction record
            Transactions::create([
                'user_id'   => $user->id,
                'amount'    => $bonusAmount,
                'type'      => $claimType, // Store as 'level_1_claim', 'level_2_claim', etc.
                'datetime'  => now(),
            ]);
    
            DB::commit();
            return redirect()->back()->with('success', "Bonus for Level $level claimed successfully!");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error processing claim. Please try again.');
        }
    }
    
}
