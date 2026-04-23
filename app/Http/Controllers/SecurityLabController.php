<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityLabController extends Controller
{
    public function xss(Request $request)
    {
        // For demonstration, we simulate malicious input if passed via query string
        $input = $request->query('payload', '<script>alert("XSS Vulnerability Detected!");</script>');
        return view('security.xss', compact('input'));
    }

    public function csrf()
    {
        return view('security.csrf');
    }

    public function csrfSubmit(Request $request)
    {
        // This endpoint will only be reached if CSRF token is valid
        return back()->with('success', 'CSRF Validation Passed! The form was submitted securely.');
    }

    public function headers()
    {
        return view('security.headers');
    }
}
