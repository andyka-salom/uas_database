<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
        public function handle(Request $request, Closure $next)
        {
            // Check jika user aktif (status = 1)
            if (auth()->check() && auth()->user()->status == 1) {
                return $next($request);
            }
    
            // Redirect jika tidak aktif atau tidak login
            return redirect('/login')->with('error', 'Akun tidak aktif atau tidak valid.');
        }
    }
