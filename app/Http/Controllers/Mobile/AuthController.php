<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->whereIn('role', array(3, 4))->with(['role_data'])->first();

        $credentials = $request->only('email', 'password');
        $remember = false;

        if ($request->has('remember')) {
            $remember = $request->remember;
        }

        if (!Auth::attempt($credentials, $remember)) {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorised'], 401);
        }

        $data['user'] = $user;

        return $this->sendResponse($data, 'User login');
    }

    public function register(Request $request)
    {
        $data = $request->input();
        $data['password'] = Hash::make($request->password);

        $data = User::create($data);

        return $this->sendResponse(User::with(['role_data'])->find($data->id), 'User registered');
    }
    
    public function profile(Request $request)
    {
        return $this->sendResponse(User::with('role_data')->find($request->user()->id), 'User profile');
    }
}
