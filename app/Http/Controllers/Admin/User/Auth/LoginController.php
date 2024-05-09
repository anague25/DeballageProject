<?php

namespace App\Http\Controllers\Admin\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Auth\LoginRequest;

class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('verified');
    // }

    public function __invoke(LoginRequest $request)
    {
        // Authentifier l'utilisateur
        if (Auth::attempt($request->validated())) {
            // Vérifier si l'e-mail de l'utilisateur est vérifié
            if (Auth::user()->hasVerifiedEmail()) {
                $accessToken = Auth::user()->createToken('authToken')->plainTextToken;
                return response()->json(['access_token' => $accessToken], 200);
            } else {
                Auth::logout();
                return response()->json(['message' => 'Please verify your email before logging in.'], 403);
            }
        } else {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }
    }
}
