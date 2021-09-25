<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     **  path="/auth/login",
     *   tags={"Authentification"},
     *   summary="User login",
     *   operationId="login",
     * 
     *   @OA\Parameter(
     *      name="email",
     *      in="header",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="header",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="remember",
     *      in="header",
     *      required=false,
     *      @OA\Schema(
     *          type="boolean"
     *      )
     *   ),
     * 
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        $credentials = $request->only('email', 'password');
        $remember = false;

        if ($request->has('remember')) {
            $remember = $request->remember;
        }

        if (!Auth::attempt($credentials, $remember)) {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorised'], 401);
        }

        $data['user'] = $user;
        $data['token'] = $user->createToken($request->email)->plainTextToken;

        return $this->sendResponse($data, 'User login');
    }

    /**
     * @OA\Post(
     **  path="/auth/logout",
     *   tags={"Authentification"},
     *   summary="User logout",
     *   operationId="logout",
     *   security={{"bearer_token": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->sendResponse([], 'User logout');
    }

    /**
     * @OA\Get(
     **  path="/auth/profile",
     *   tags={"Authentification"},
     *   summary="Get current user profile",
     *   operationId="profil",
     *   security={{"bearer_token": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function profile(Request $request)
    {
        return $this->sendResponse(User::with('role_data')->find($request->user()->id), 'User profile');
    }

    /**
     * @OA\Get(
     **  path="/auth/refresh/token",
     *   tags={"Authentification"},
     *   summary="User token refresh",
     *   operationId="refresh_token",
     *   security={{"bearer_token": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->sendResponse(['token' => $user->createToken($request->email)->plainTextToken], 'User token refreshed');
    }
}
