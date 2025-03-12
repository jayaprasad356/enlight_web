<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\Users;
use App\Models\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class InactiveUsersController extends Controller
{
    public function index(Request $request)
    {
        $news = News::latest()->first(); // Fetch latest news
        
        // Get user_id from session
        $user_id = Session::get('user_id');
    
        // Fetch the user from the database
        $user = Users::find($user_id);
    
        // If user is not found, logout and redirect to login
        if (!$user) {
            Auth::logout();
            Session::flush(); // Clear session data
            return redirect()->route('mobile.login')->with('error', 'Session expired. Please log in again.');
        }
    
        // Get user balance
        $recharge = $user->recharge ?? 0;
        $refer_code = $user->refer_code ?? 0;
    
        // Fetch inactive users with status 0 and matching refer_code
        $users = Users::where('status', 0)
                      ->where('level_1_refer', $user->refer_code)
                      ->get();

                      $customers = collect(); // Initialize as an empty collection

                      if ($request->has('mobile') && !empty($request->mobile)) {
                          $customers = Users::where('mobile', $request->mobile)->get();
                      }
    
        // Return the view with users and balance
        return view('inactive_users.index', compact('users', 'recharge', 'news','customers','refer_code'));
    }

  
    public function activate(Request $request)
    {
        // Get the logged-in user's user_id from session
        $user_id = Session::get('user_id');
        
        // Fetch the logged-in user from the database
        $user = Users::find($user_id);
        
        // If user is found, get their balance, else default to 0
        $recharge = $user ? $user->recharge : 0;
        
        // Get the user details (id, name, mobile, level) from the query parameters
        $id = $request->query('id');  // use 'id' instead of 'userId'
        $userName = $request->query('name');
        $userMobile = $request->query('mobile');
        $level = $request->query('level');
        
        // Return the activation view with the user details, level, and balance
        return view('inactive_users.activate', compact('user', 'id', 'userName', 'userMobile', 'level', 'recharge'));
    }
 
    public function activateusers(Request $request)
    {
        $user_id = Session::get('user_id');
        $sessionUser = Users::find($user_id);
    
        // Ensure session user exists
        if (!$sessionUser) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please log in again.'
            ], 401);
        }
    
        // Check if session user has sufficient balance
        if ($sessionUser->recharge < 299) {
            return response()->json([
                'success' => false,
                'message' => 'Low Recharge Balance - Add Recharge & Activate'
            ], 400);
        }
    
        // Get selected user to be activated
        $selectedUserId = $request->query('id');
        $selectedUser = Users::find($selectedUserId);
    
        // Ensure the selected user exists
        if (!$selectedUser) {
            return response()->json([
                'success' => false,
                'message' => 'Selected user does not exist.'
            ], 400);
        }
    
        DB::beginTransaction();
        try {
            $level = $request->query('level');
            $selectedLevelUser = null;
            $addLevelIncome = false;
    
            // **Level 1 Activation**
            if ($level == 1) {
                $referralCount = Users::where('level_1_refer', $sessionUser->refer_code)
                    ->where('status', 1)
                    ->count();
                if ($referralCount >= 10) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only 10 members are allowed in Level 1.'
                    ], 400);
                }

                DB::table('transactions')->insert([
                    'user_id' => $sessionUser->id,
                    'type' => 'refer_income',
                    'amount' => 50,
                    'datetime' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $selectedUser->level_1_refer = $sessionUser->refer_code;
                $sessionUser->refer_income += 50;
                $selectedUser->save();
                
            }
    
            // **Level 2 Activation**
            if ($level == 2) {
                $selectedLevelUserId = $request->query('level_user_id');
                $selectedLevelUser = Users::find($selectedLevelUserId);
    
                if (!$selectedLevelUser) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Selected Level 1 user does not exist.'
                    ], 400);
                }
    
                // Check referral count
                $referralCount = Users::where('level_1_refer', $selectedLevelUser->refer_code)
                    ->where('status', 1)
                    ->count();
                if ($referralCount >= 30) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only 30 members are allowed in Level 2.'
                    ], 400);
                }
    
                $selectedUser->level_1_refer = $selectedLevelUser->refer_code;
                $selectedUser->level_2_refer = $sessionUser->refer_code;
                $selectedUser->save();
    
                $selectedLevelUser->refer_income += 50;
                $selectedLevelUser->save();
            }
    
            // **Level 3 Activation**
            if ($level == 3) {
                $selectedLevelUserId = $request->query('level_user_id');
                $selectedLevelUser = Users::find($selectedLevelUserId);
    
                if (!$selectedLevelUser) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Selected Level 2 user does not exist.'
                    ], 400);
                }
    
                $referralCount = Users::where('level_1_refer', $selectedLevelUser->refer_code)
                    ->where('status', 1)
                    ->count();
                if ($referralCount >= 90) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only 90 members are allowed in Level 3.'
                    ], 400);
                }
    
                $selectedUser->level_2_refer = $selectedLevelUser->refer_code;
                $selectedUser->level_3_refer = $sessionUser->refer_code;
                $selectedUser->save();
    
                $selectedLevelUser->refer_income += 50;
                $selectedLevelUser->save();
            }
    
            // **Level 4 Activation**
            if ($level == 4) {
                $selectedLevelUserId = $request->query('level_user_id');
                $selectedLevelUser = Users::find($selectedLevelUserId);
    
                if (!$selectedLevelUser) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Selected Level 3 user does not exist.'
                    ], 400);
                }
    
                $referralCount = Users::where('level_1_refer', $selectedLevelUser->refer_code)
                    ->where('status', 1)
                    ->count();
                if ($referralCount >= 270) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only 270 members are allowed in Level 4.'
                    ], 400);
                }
    
                $selectedUser->level_3_refer = $selectedLevelUser->refer_code;
                $selectedUser->level_4_refer = $sessionUser->refer_code;
                $selectedUser->save();
    
    
                // Update refer_income for the level user
                $selectedLevelUser->refer_income += 50;
                $selectedLevelUser->save();
            }
    
            // **Activate selected user**
            $selectedUser->status = 1;
            $selectedUser->purchase_wallet += 299;
            $selectedUser->save();
            
    
            // **Deduct balance from session user**
            $sessionUser->recharge -= 299;
            $sessionUser->save();
    
            // Log Transactions
            DB::table('transactions')->insert([
                'user_id' => $selectedUser->id,
                'type' => "level_{$level}_activation",
                'amount' => 299,
                'datetime' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add refer income transaction if applicable
            if ($selectedLevelUser) {
                DB::table('transactions')->insert([
                    'user_id' => $selectedLevelUser->id,
                    'type' => 'refer_income',
                    'amount' => 50,
                    'datetime' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

               // Define refer income mapping based on the level
            $referIncomeMapping = [
                2 => 25,
                3 => 10,
                4 => 5
            ];

            // Get refer income amount for this level
            $referIncomeAmount = $referIncomeMapping[$level] ?? 0;

            // Check if refer income should be added
            if ($referIncomeAmount > 0) {
                // Add refer income transaction for the session user
                DB::table('transactions')->insert([
                    'user_id' => $sessionUser->id,
                    'type' => 'refer_income',
                    'amount' => $referIncomeAmount,
                    'datetime' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Update session user's refer_income balance
                $sessionUser->refer_income += $referIncomeAmount;
                $sessionUser->save();
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'User activated successfully.'
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to activate user: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate user. Please try again.'
            ], 500);
        }
    }
    public function getLevelUsers(Request $request)
    {
        $userId = Session::get('user_id');  // Get the logged-in user's ID from session
        $level = $request->input('level');
    
        // Map levels to their corresponding names (Level C, D, E)
        $levelMapping = [
            1 => 'b', 
            2 => 'c',  // Level 2 => Level C
            3 => 'd',  // Level 3 => Level D
            4 => 'e'   // Level 4 => Level E
        ];
    
        $mappedLevel = isset($levelMapping[$level]) ? $levelMapping[$level] : null;
    
        if (!$mappedLevel) {
            return response()->json(['error' => 'Invalid level'], 400);
        }
    
        // Log the user ID and level before making the API call
        Log::info("Fetching users for user_id: $userId, level: $mappedLevel");
    
        // Call the API to fetch the users based on the user_id and level
        try {
            $response = Http::post('https://enlightapp.in/api/level', [
                'user_id' => $userId,
                'level' => $mappedLevel  // Use mapped level
            ]);
        } catch (\Exception $e) {
            // Log the error if the API call fails
            Log::error('Failed to call API: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch users.'], 500);
        }
    
        $data = $response->json(); // Convert API response to an array
    
        if (!$data['success']) {
            // Log the failed response
            Log::error('API Response Error: ' . json_encode($data));
            return response()->json(['error' => 'Failed to fetch users.'], 500);
        }
    
        // Return the data to the frontend
        return response()->json([
            'data' => $data['data'] // Assuming the 'data' key contains the user list
        ]);
    }



}
    

    



