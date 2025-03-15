<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function level1List()
    {
        // Get user_id from session
        $user_id = Session::get('user_id');
    
        // Check if user_id exists
        if (!$user_id) {
            return redirect()->route('mobile.login')->withErrors(['error' => 'Unauthorized access. Please log in.']);
        }
    
        // Call the API to get level data
        $response = Http::post('https://enlightapp.in/api/level', [
            'user_id' => $user_id,
            'level' => 'b'
        ]);
    
        // Convert response to array
        $data = $response->json();
    
        // Ensure data exists and is an array
        $users = $data['success'] ? ($data['data'] ?? []) : [];
    
        // Pass data to view
        return view('level_1.index', [
            'user_id' => $user_id,
            'users' => $users
        ]);
    }
    

    public function level2List()
    {
        // Get user_id from session
        $user_id = Session::get('user_id');
    
        // Check if user_id exists
        if (!$user_id) {
            return redirect()->route('mobile.login')->withErrors(['error' => 'Unauthorized access. Please log in.']);
        }
    
        // Call the API to get level data
        $response = Http::post('https://enlightapp.in/api/level', [
            'user_id' => $user_id,
            'level' => 'c'
        ]);
    
        // Convert response to array
        $data = $response->json();
    
        // Ensure data exists and is an array
        $users = $data['success'] ? ($data['data'] ?? []) : [];
    
        // Pass data to view
        return view('level_2.index', [
            'user_id' => $user_id,
            'users' => $users
        ]);
    }
    
    public function level3List()
    {
        // Get user_id from session
        $user_id = Session::get('user_id');
    
        // Check if user_id exists
        if (!$user_id) {
            return redirect()->route('mobile.login')->withErrors(['error' => 'Unauthorized access. Please log in.']);
        }
    
        // Call the API to get level data
        $response = Http::post('https://enlightapp.in/api/level', [
            'user_id' => $user_id,
            'level' => 'd'
        ]);
    
        // Convert response to array
        $data = $response->json();
    
        // Ensure data exists and is an array
        $users = $data['success'] ? ($data['data'] ?? []) : [];
    
        // Pass data to view
        return view('level_3.index', [
            'user_id' => $user_id,
            'users' => $users
        ]);
    }
    

    public function level4List()
    {
        // Get user_id from session
        $user_id = Session::get('user_id');
    
        // Check if user_id exists
        if (!$user_id) {
            return redirect()->route('mobile.login')->withErrors(['error' => 'Unauthorized access. Please log in.']);
        }
    
        // Call the API to get level data
        $response = Http::post('https://enlightapp.in/api/level', [
            'user_id' => $user_id,
            'level' => 'e'
        ]);
    
        // Convert response to array
        $data = $response->json();
    
        // Ensure data exists and is an array
        $users = $data['success'] ? ($data['data'] ?? []) : [];
    
        // Pass data to view
        return view('level_4.index', [
            'user_id' => $user_id,
            'users' => $users
        ]);
    }
    
    public function getUserReferrals(Request $request)
{
    $user_id = $request->input('user_id');

    if (!$user_id) {
        return response()->json([
            'success' => false,
            'message' => 'User ID is required',
        ], 400);
    }

    // Get user's refer_code
    $user = DB::table('users')->where('id', $user_id)->select('refer_code')->first();
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    $refer_code = $user->refer_code;

    // Count referrals for each level
    $level_1_count = DB::table('users')->where('level_1_refer', $refer_code)->where('status', 1)->count();
    $level_2_count = DB::table('users')->where('level_2_refer', $refer_code)->where('status', 1)->count();
    $level_3_count = DB::table('users')->where('level_3_refer', $refer_code)->where('status', 1)->count();
    $level_4_count = DB::table('users')->where('level_4_refer', $refer_code)->where('status', 1)->count();

    return response()->json([
        'success' => true,
        'level_1_count' => $level_1_count,
        'level_2_count' => $level_2_count,
        'level_3_count' => $level_3_count,
        'level_4_count' => $level_4_count,
    ]);
}

}
