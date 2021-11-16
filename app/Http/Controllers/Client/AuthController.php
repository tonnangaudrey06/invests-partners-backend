<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required',
            'password' => 'bail|required',
        ]);

        $credentials = $request->only('email', 'password');

        $remember = false;

        if ($request->has('remember')) {
            if ($request->remember == 'on') {
                $remember = true;
            }
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'credential' => 'Désolé, vos informations d\'identification sont incorrectes, veuillez réessayer.',
        ])->withInput(request()->except('password'));
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
