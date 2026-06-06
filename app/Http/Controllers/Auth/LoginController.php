<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. User ko email se find karein
        $user = User::where('email', $request->email)->first();

        // 2. Check karein ke user exist karta hai aur password match hota hai
        if ($user && Hash::check($request->password, $user->password)) {
            
            // Password match ho gaya, ab Login karein
            Auth::login($user);

            // 3. Admin Redirect Check
            if ($user->is_admin == 1 || $request->email === 'admin@gmail.com') {
                return redirect()->route('admin.dashboard');
            }

            // 4. Normal User Redirect
            return redirect()->intended('/');
        }

        // 5. Agar error aaye
        return back()->withErrors(['email' => 'Invalid credentials, please check your email and password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}