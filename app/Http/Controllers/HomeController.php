<?php

namespace App\Http\Controllers;

use App\Models\AccountList;
use App\Models\Announcement;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\Event;
use App\Models\LandingPageSection;
use App\Models\Meeting;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Payees;
use App\Models\Avatars;
use App\Models\Users;
use App\Models\UserCalls;
use App\Models\Withdrawals;
use App\Models\Payer;
use App\Models\News;
use App\Models\Plan;
use App\Models\Ticket;
use App\Models\Admin;
use App\Models\Transactions;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = session('user_id'); // Get user_id from session
    
        if (!$userId) {
            return redirect()->route('mobile.login')->withErrors(['error' => 'Unauthorized access']);
        }
    
        // Fetch user details
        $user = Users::where('id', $userId)->first();
    
        // Fetch financial details (modify according to your database structure)
        $monthly_salary = $user->monthly_salary ?? 0;
        $level_income = $user->level_income ?? 0; // User balance
        $whatsapp_status_income = $user->whatsapp_status_income ?? 0;
        $refer_income = $user->refer_income ?? 0;
        $payment_wallet = $user->payment_wallet ?? 0;
        $news = news::latest()->first(); // Adjust this according to your database
    
        return view('dashboard.dashboard', compact('monthly_salary', 'level_income', 'whatsapp_status_income','refer_income', 'news','payment_wallet'));
    }
  
    public function addToBalance(Request $request)
    {
        $userId = session('user_id'); // Get user ID from session
    
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access']);
        }
    
        $user = Users::where('id', $userId)->first();
    
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    
        $type = $request->input('type'); // Type: monthly_salary, level_income, refer_income, etc.
        $amount = floatval($request->input('amount')); // Amount to be added
    
        if ($amount <= 0) {
            return response()->json(['success' => false, 'message' => 'No Balance Available']);
        }
    
        // Check if the user has enough active referrals for each level
        $requiredReferrals = [
            1 => 3,   // Level 1 - 3 active referrals
            2 => 9,   // Level 2 - 9 active referrals
            3 => 27,  // Level 3 - 27 active referrals
            4 => 81,  // Level 4 - 81 active referrals
        ];
    
        foreach ($requiredReferrals as $level => $requiredCount) {
            $activeReferrals = Users::where("level_{$level}_refer", $user->refer_code)
                ->where('status', 1) // Only count active referrals
                ->count();
    
            if ($activeReferrals < $requiredCount) {
                return response()->json([
                    'success' => false,
                    'message' => "You need at least $requiredCount active referrals for Level $level."
                ]);
            }
        }
    
        // Process the deduction based on income type
        if ($type === 'monthly_salary') {
            if ($user->monthly_salary < $amount) {
                return response()->json(['success' => false, 'message' => 'Insufficient Monthly Salary']);
            }
            $user->monthly_salary -= $amount;
        } elseif ($type === 'level_income') {
            if ($user->level_income < $amount) {
                return response()->json(['success' => false, 'message' => 'Insufficient Level Income']);
            }
            $user->level_income -= $amount;
        } elseif ($type === 'refer_income') {
            if ($user->refer_income < $amount) {
                return response()->json(['success' => false, 'message' => 'Insufficient Refer Income']);
            }
            $user->refer_income -= $amount;
        } elseif ($type === 'whatsapp_status_income') {
            if ($user->whatsapp_status_income < $amount) {
                return response()->json(['success' => false, 'message' => 'Insufficient Whatsapp Status Income']);
            }
            $user->whatsapp_status_income -= $amount;
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid income type']);
        }
    
        // Add to user balance
        $user->balance += $amount;
        $user->save();
    
        // Insert transaction record
        DB::table('transactions')->insert([
            'user_id' => $userId,
            'type' => $type,
            'amount' => $amount,
            'datetime' => now(), // Current timestamp
        ]);
    
        return response()->json(['success' => true, 'message' => 'Amount added to your balance successfully']);
    }
    
}

    

