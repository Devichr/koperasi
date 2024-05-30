<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            switch (Auth::user()->role) {
                case 'anggota':
                    return redirect()->route('loans.create');
                case 'bendahara':
                    return redirect()->route('treasurer.loans.index');
                case 'ketua':
                    return redirect()->route('chair.loans.index');
                default:
                    return redirect()->route('login');
            }
        }

        return $next($request);
    }
}

