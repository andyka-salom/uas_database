<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth; 
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        // Periksa apakah pengguna telah login
        if (Auth::check()) {
            // Periksa apakah idrole pengguna sesuai dengan yang diharapkan
            if (Auth::user()->idrole == $role) {
                return $next($request);
            }
        }

        // Redirect atau berikan respon sesuai kebijakan Anda jika tidak memenuhi syarat
        return redirect('/unauthorized');
    }
}
