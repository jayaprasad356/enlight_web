<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class OTPResetsController extends Controller
{
    // Show Mobile Input Form
    public function showMobileForm()
    {
        return view('auth.passwords.otp');
    }

    // Send OTP to Mobile
    public function sendOTP(Request $request)
    {
        $request->validate(['mobile' => 'required|digits:10']);

        $user = Users::where('mobile', $request->mobile)->first();
        if (!$user) {
            return response()->json(['error' => 'Mobile number not found!'], 404);
        }

        $otp = rand(100000, 999999); // Generate 6-digit OTP

        // Store OTP and mobile in session
        Session::put('otp', (string) $otp);
        Session::put('mobile', $request->mobile);
        Session::save();

        // Send OTP via AuthKey API
        try {
            $response = Http::get("https://api.authkey.io/request", [
                'authkey' => env('AUTHKEY_API_KEY'),
                'mobile' => $request->mobile,
                'country_code' => "91",
                'sid' => "14031",
                'otp' => $otp,
                'company' => "enlight"
            ]);

            if ($response->successful()) {
                return response()->json(['success' => 'OTP sent successfully!']);
            } else {
                return response()->json(['error' => 'Failed to send OTP.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'OTP service unavailable. Try again later.'], 500);
        }
    }

    // Verify OTP
    public function verifyOTP(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        if (Session::get('otp') != $request->otp) {
            return response()->json(['error' => 'Invalid OTP!'], 400);
        }

        return response()->json(['success' => 'OTP verified successfully!']);
    }

    // Show Reset Password Form
    public function showResetForm()
    {
        if (!Session::has('mobile')) {
            return redirect()->route('password.otp')->withErrors(['otp' => 'Session expired!']);
        }
        return view('auth.passwords.reset_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        // Get mobile number from session (verified via OTP)
        $mobile = Session::get('mobile');
        if (!$mobile) {
            return response()->json(['error' => 'Session expired! Please request OTP again.'], 400);
        }
    
        // Update password
        Users::where('mobile', $mobile)->update([
            'password' => $request->password
        ]);
    
        // Clear session
        Session::forget(['otp', 'mobile']);
    
        return response()->json([
            'success' => 'Password updated successfully!',
            'redirect' => route('mobile.login')
        ]);
    }
    
}
