<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Users;
use App\Models\Withdrawals;
use App\Models\payment_screenshots;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $today = now()->toDateString(); // Get today's date in YYYY-MM-DD format

        // Fetch total users count
        $total_users = Users::count();

        // Fetch today's activated levels count from Transactions table
        $today_level_1 = Transactions::where('type', 'level_1_activation')->whereDate('datetime', $today)->count();
        $today_level_2 = Transactions::where('type', 'level_2_activation')->whereDate('datetime', $today)->count();
        $today_level_3 = Transactions::where('type', 'level_3_activation')->whereDate('datetime', $today)->count();
        $today_level_4 = Transactions::where('type', 'level_4_activation')->whereDate('datetime', $today)->count();

        // Fetch today's registrations count from Users table
        $today_registration = Users::whereDate('created_at', $today)->count();

        // Fetch unpaid withdrawals count from Withdrawals table (status = 0)
        $unpaid_withdrawals = Withdrawals::where('status', 0)->count();

        $pending_recharge = payment_screenshots::where('status', 0)->count();

        return view('dashboard.dashboard', compact(
            'total_users', 
            'today_level_1',
            'today_level_2',
            'today_level_3',
            'today_level_4',
            'today_registration',
            'unpaid_withdrawals',
            'pending_recharge'
        ));
    }
}
