<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if($request->user()->hasRole('seller')) {
        //     return $next($request);
        // }
        if ($request->user() && $request->user()->role === 'seller') {
            return $next($request); // Lanjutkan ke rute berikutnya
        }return redirect('/');
    }
}
