<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

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
                Session::put('refer_code', $user->refer_code); // Store refer_code in session
                Session::put('avatar', !empty($user->avatar) ? $user->avatar : 'default_avatar.png');

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
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
    ]);

    // Update fields
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
    if ($request->filled('password')) {
        $user->password = $request->password;
    }

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($user->avatar && file_exists(storage_path('app/public/uploads/avatar/' . $user->avatar))) {
            unlink(storage_path('app/public/uploads/avatar/' . $user->avatar));
        }

        // Store new image
        $avatarPath = $request->file('avatar')->store('avatar', 'public');
        $user->avatar = basename($avatarPath);

        Session::put('avatar', $user->avatar);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}


public function showRegistrationForm($refer_code = null)
{
    return view('auth.addusers', compact('refer_code'));
}



public function register(Request $request)
{
// Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'password' => 'required|string|min:8',
        'pincode' => 'required|string|min:6|max:6',
        'age' => 'required|integer|min:18', // Assuming age should be an integer and at least 18
        'gender' => 'required|string|max:255',
        'level_1_refer' => 'required|string|max:255',
    ]);

    // API endpoint to register the user
    $apiUrl = 'https://enlightapp.in/api/register';  // Replace with your actual registration API URL

    // Prepare the data to send to the API
    $apiData = [
        'name' => $validated['name'],
        'mobile' => $validated['mobile'],
        'password' => $validated['password'],  // Encrypt the password
        'pincode' => $validated['pincode'],
        'age' => $validated['age'],
        'gender' => $validated['gender'],
        'level_1_refer' => $validated['level_1_refer'], // Automatically use the logged-in user's refer_code from session
    ];

    // Make the API request (you can also use other libraries like Guzzle if needed)
    $response = Http::post($apiUrl, $apiData);

    // Check if the registration was successful
    $responseData = $response->json(); // Decode the JSON response

    if ($response->successful() && isset($responseData['success']) && $responseData['success'] === true) {
        return redirect()->route('mobile.login')->with('success', $responseData['message'] ?? 'User registered successfully.');
    } else {
        return back()->with('error', 'Registration failed. Please try again.');
    }
    
}

    public function logout()
    {
        Session::flush(); // Clear all session data
        Session::forget('user_id'); 
        Session::forget('user_name'); 

        return redirect()->route('mobile.login')->with('success', 'Logged out successfully');
    }

}
