<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
        $response = Http::post('https://enlight.abcdapp.in/api/level', [
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
        $response = Http::post('https://enlight.abcdapp.in/api/level', [
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
        $response = Http::post('https://enlight.abcdapp.in/api/level', [
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
        $response = Http::post('https://enlight.abcdapp.in/api/level', [
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
    
}
