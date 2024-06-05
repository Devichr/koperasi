<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckStep1
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('loan_step1')) {
            return redirect()->route('loans.step1.create')->with('error', 'Please complete the first step of the loan application.');
        }

        return $next($request);
    }
}
