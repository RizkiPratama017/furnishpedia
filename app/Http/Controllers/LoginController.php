<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{




    public function index()
    {
        return view('login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            // 'email'=>'required|email:dns',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //remember
        $remember = $request->has('remember');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect ke halaman login
        return redirect('/');
    }
}
