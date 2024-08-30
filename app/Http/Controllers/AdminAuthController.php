<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username_or_email', 'password');

        $fieldType = filter_var($credentials['username_or_email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Log the credentials for debugging purposes
        Log::info('Attempting login with:', $credentials);

        if (Auth::guard('admin')->attempt([$fieldType => $credentials['username_or_email'], 'password' => $credentials['password']])) {
            return redirect()->route('admin.users.index');
        }

        Log::error('Login attempt failed for:', $credentials);

        return back()->withErrors([
            'username_or_email' => 'Email or password is incorrect',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
