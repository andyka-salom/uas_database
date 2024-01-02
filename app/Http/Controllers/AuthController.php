<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:1',
        ]);

        $user = DB::table('users')
            ->where('username', $credentials['username'])
            ->first();

        if ($user && $credentials['password'] === $user->PASSWORD) {
            Auth::loginUsingId($user->id, true);
            $request->session()->regenerate();

            if ($user->idrole === 1) { 
                return redirect()->route('roles.index')->with('success', 'Login berhasil.');
            } elseif ($user->idrole === 2) { 
                return redirect()->route('pengadaan.index')->with('success', 'Berhasil Login');
            }
        }

        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }
}
