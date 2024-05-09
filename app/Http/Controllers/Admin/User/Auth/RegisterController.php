<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\User;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Auth\RegisterRequest;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        //verification d'email
        Mail::to($user)->send(new EmailVerification($user));

        return response()->json(['message' => 'User registered successfully. Please verify your email.'], 201);
    }
}
