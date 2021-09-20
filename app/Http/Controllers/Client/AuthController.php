<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function logout()
	{
		Auth::logout();
		return redirect()->route('login')->with('sucess', 'User logout successfully!');
	}

	public function login()
	{
		Auth::logout();
		return redirect()->route('dashboard')->with('sucess', 'User login successfully!');
	}
}
