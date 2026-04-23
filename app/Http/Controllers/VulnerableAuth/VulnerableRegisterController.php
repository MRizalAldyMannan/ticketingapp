<?php

namespace App\Http\Controllers\VulnerableAuth;

use App\Http\Controllers\Controller;
use App\Models\VulnerableUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VulnerableRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('vulnerable-auth.register');
    }

    /**
     * Handle an incoming registration request.
     * VULNERABLE:
     * 1. Weak password validation rules (no min length, no complexity)
     * 2. Plaintext password storage (no Hash::make)
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔴 VULNERABILITY: No strict password validation (min:8, letters, numbers, etc)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.VulnerableUser::class],
            'password' => ['required', 'confirmed'], // No Rules\Password::defaults()
        ]);

        // 🔴 VULNERABILITY: Plain text password storage!
        // Storing directly without Hash::make()
        $user = VulnerableUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, 
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/tickets');
    }
}
