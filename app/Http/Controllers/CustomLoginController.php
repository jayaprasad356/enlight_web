<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Session;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.mobile-login');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required',
        ]);
    
        // Find user by mobile number
        $user = Users::where('mobile', $request->mobile)->first();
    
        // Check user existence and manually verify password (without hashing)
        if ($user) {
            if ($user->status == 0) {
                return back()->withErrors(['mobile' => 'Your account is not activated.'])->withInput();
            }
    
            if ($user->status == 2) {
                return back()->withErrors(['mobile' => 'Your account has been rejected.'])->withInput();
            }
    
            if ($request->password === $user->password) {
                // Store user details in session
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
    
                // Redirect to password change page ONLY if they have level_1_refer AND haven't updated their password before
                if (!empty($user->level_1_refer) && !$user->password_updated) {
                    return redirect()->route('force.change.password')->with('message', 'You need to change your password before proceeding.');
                }
    
                return redirect()->route('my_products.index')->with('success', 'Login successful');
            }
        }
    
        return back()->withErrors(['mobile' => 'Invalid credentials'])->withInput();
    }

    public function showChangePasswordForm()
{
    return view('auth.force-change-password');
}

    public function changePassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Users::find(Session::get('user_id'));

    if ($user) {
        $user->password = $request->password; // Make sure to hash this in real applications
        $user->password_updated = true; // Mark password as updated
        $user->save();

        return redirect()->route('mobile.login')->with('success', 'Password changed successfully.');
    }

    return redirect()->route('mobile.login')->withErrors(['error' => 'Something went wrong, please log in again.']);
}

public function profile()
{
    $user = Users::find(Session::get('user_id'));

    if (!$user) {
        return redirect()->route('mobile.login')->withErrors(['error' => 'User not found.']);
    }

    return view('profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Users::find(Session::get('user_id'));

    if (!$user) {
        return redirect()->route('mobile.login')->withErrors(['error' => 'User not found.']);
    }

    // Validate input
    $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'mobile' => 'sometimes|required|string|max:15|unique:users,mobile,' . $user->id,
        'age' => 'sometimes|required|integer|min:1|max:120',
        'pincode' => 'sometimes|required|string|max:10',
        'gender' => 'sometimes|required|in:male,female',
        'password' => 'nullable|min:6',
    ]);

    // Update only the fields that are provided
    if ($request->has('name')) {
        $user->name = $request->name;
    }
    if ($request->has('mobile')) {
        $user->mobile = $request->mobile;
    }
    if ($request->has('age')) {
        $user->age = $request->age;
    }
    if ($request->has('pincode')) {
        $user->pincode = $request->pincode;
    }
    if ($request->has('gender')) {
        $user->gender = $request->gender;
    }
    if ($request->has('password')) {
        $user->password = $request->password;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}


    public function logout()
    {
        Session::flush(); // Clear all session data
        Session::forget('user_id'); 
        Session::forget('user_name'); 

        return redirect()->route('mobile.login')->with('success', 'Logged out successfully');
    }

}
