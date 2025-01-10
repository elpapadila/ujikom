<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class OwnerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        if (Auth::check() && (Auth::user()->role == 'kasir' ||
        Auth::user()->role == 'admin')){
            return $next($request);
            }
                return response()->json(['Kamu tidak memiliki akses ke halaman ini']);
    }
    }

