<?php

namespace App\Http\Controllers\VulnerableAuth;

use App\Http\Controllers\Controller;
use App\Models\VulnerableUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VulnerableLoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('vulnerable-auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * VULNERABLE:
     * 1. No Rate Limiting (Brute Force allowed)
     * 2. Manual query and plaintext password check (No proper hashing)
     * 3. No Session Regeneration (Session Hijacking risk)
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 🔴 VULNERABILITY 1: Plaintext / Md5 Password Check 
        // 🔴 VULNERABILITY 2: No Rate Limiting against Bruteforce
        
        $user = VulnerableUser::where('email', $request->email)->first();

        // In a real vulnerable scenario, they might just do $user->password === $request->password.
        if ($user && $user->password === $request->password) {
            
            // Log the user in manually (Bypassing secure session mechanisms)
            Auth::guard('web')->login($user, $request->boolean('remember'));

            // 🔴 VULNERABILITY 3: Missing $request->session()->regenerate();
            // This leaves the application vulnerable to Session Fixation/Hijacking
            
            return redirect()->intended('/tickets');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        // Should invalidate the session, we'll keep it secure on logout for general stability
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
