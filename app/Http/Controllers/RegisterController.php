<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
            
        ]);

        $validatedData['role'] = 'buyer';
        $validatedData['password'] = Hash::make($validatedData['password']); 

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}
