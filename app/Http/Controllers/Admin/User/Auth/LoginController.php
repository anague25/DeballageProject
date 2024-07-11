<?php

namespace App\Http\Controllers\Admin\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Auth\LoginRequest;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {

        if (Auth::attempt($request->validated())) {

            $accessToken = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json(['access_token' => $accessToken, 'user' => Auth::user()], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }
    }
}
