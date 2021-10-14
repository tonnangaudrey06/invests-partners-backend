<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Storage;
use App\Mail\InscriptionMail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('role', $request->role)->with(['role_data', 'documents_fiscaux', 'profil_invest'])->first();

        // return $this->sendError(null, $user, 500);

        if (empty($user)) {
            return $this->sendError("Ce compte n'existe pas. Créez-en un avant de vous connecter.", null, 500);
        }

        $credentials = $request->only('email', 'password');

        if (!$request->has('remember') || !$request->remember) {
            Passport::personalAccessTokensExpireIn(now()->addMinutes(1));
        }


        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError("Votre mot de passe est incorrect. Modifiez-le puis réessayez.", null, 500);
        }

        // if (!Auth::attempt($credentials)) {
        //     return $this->sendError("Votre mot de passe est incorrect. Modifiez-le puis réessayez.", null, 500);
        // }

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
        return $this->sendResponse(User::with(['role_data', 'documents_fiscaux', 'profil_invest'])->find($request->user()->id), 'User profile');
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

        // $email = User::where('email', $request->email)->get();
        // $telephone = User::where('telephone', $request->telephone)->get();

        // if(!empty($email)) {

        //     return $this->sendError("L'email '$request->email' à déjà été utilisé pour un compte. Veuillez fournir une autre adresse mail.", null, 500);
        // }

        // if(!empty($telephone)) {
        //     return $this->sendError("Le numéro de téléphone '$request->telephone' à déjà été utilisé pour un compte. Veuillez fournir un autre numéro de téléphone.", null, 500);
        // }

        try {
            Storage::disk('public')->makeDirectory('uploads/' . $data['folder']);
        } catch (\Throwable $th) {
            return $this->sendError("La création de votre compte a échoué, veuillez réessayer. Si le problème persiste, veuillez contacter Invest & Partners pour obtenir de l'aide.", null, 500);
        }

        $data = User::create($data);

        $user = User::with(['role_data', 'documents_fiscaux', 'profil_invest'])->find($data->id);

        Mail::to($user->email)
            ->queue(new InscriptionMail($user->toArray()));

        return $this->sendResponse($user, 'User registered');
    }

    public function checkRegister(Request $request)
    {
        $email = User::where('email', $request->email)->where('role', $request->role)->get();
        $telephone = User::where('telephone', $request->telephone)->where('role', $request->role)->get();

        if (count($email) > 0) {
            return $this->sendError("L'email '$request->email' à déjà été utilisé pour un compte. Veuillez fournir une autre adresse mail.", null, 500);
        }

        if (count($telephone) > 0) {
            return $this->sendError("Le numéro de téléphone '$request->telephone' à déjà été utilisé pour un compte. Veuillez fournir un autre numéro de téléphone.", null, 500);
        }

        return $this->sendResponse(null, 'User registratioin form OK');
    }
}
