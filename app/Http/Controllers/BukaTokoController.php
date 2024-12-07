<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukaTokoController extends Controller
{
    public function index()
    {
        // Periksa apakah user login dan role adalah 'buyer'
        if (Auth::check() && Auth::user()->role === 'buyer') {
            return view('bukatoko', [
                'title' => 'Buka Toko'
            ]);
        }

        // Redirect jika role bukan 'buyer'
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}
