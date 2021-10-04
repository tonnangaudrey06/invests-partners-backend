<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->whereIn('role', array(3, 4))->with(['role_data', 'documents_fiscaux'])->first();

        if(empty($user)) {
            return $this->sendError('Le compte utilisateur n\'existe pas. Veuillez d\'abord créer un compte.', null, 401);
        }

        $credentials = $request->only('email', 'password');

        if (!$request->has('remember') || !$request->remember) {
            Passport::personalAccessTokensExpireIn(now()->addMinutes(1));
        }

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Votre email ou mot de passe est incorrect. Veuillez réessayer.', null, 401);
        }

        $data['user'] = $user;
        $data['token'] = $user->createToken($request->email)->accessToken;

        return $this->sendResponse($data, 'User login');
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResponse(null, 'User logout');
    }

    public function profile(Request $request)
    {
        return $this->sendResponse(User::with(['role_data', 'documents_fiscaux'])->find($request->user()->id), 'User profile');
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->sendResponse(['token' => $user->createToken($request->email)->plainTextToken], 'User token refreshed');
    }

    public function register(Request $request)
    {
        $data = $request->input();
        $data['password'] = Hash::make($request->password);
        $data['folder'] = hexdec(uniqid());

        $email = User::where('email', $request->email)->exists();
        $telephone = User::where('telephone', $request->telephone)->exists();

        if($email) {
            return $this->sendError('L\'email est déjà utilisé.', null, 401);
        }

        if($telephone) {
            return $this->sendError('Le numéro de téléphone est déjà utilisé.', null, 401);
        }

        try {
            Storage::disk('public')->makeDirectory('uploads/'. $data['folder']);
        } catch (\Throwable $th) {
            return $this->sendError('Erreur de creation de compte', null, 401);
        }

        $data = User::create($data);

        return $this->sendResponse(User::with(['role_data', 'documents_fiscaux'])->find($data->id), 'User registered');
    }
}
