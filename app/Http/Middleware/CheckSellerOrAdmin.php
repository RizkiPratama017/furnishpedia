<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSellerOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && in_array($request->user()->role, ['seller', 'admin'])) {
            return $next($request); // Lanjutkan ke rute berikutnya
        }

        // Jika tidak memenuhi syarat, redirect ke halaman lain
        return redirect('/')->with('error', 'Access denied!');
    }
}
