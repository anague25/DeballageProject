<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth:sanctum']);
    }


    // public function sendMail()
    // {

    //     Mail::to(Auth::user())->send(new EmailVerification(Auth::user()));
    //     return response()->json([
    //         'message' => 'Email verification link send on your email!'
    //     ]);
    // }


    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return response()->json(['message' => 'Email verified successfully.'], 200);
        }

        return response()->json(['message' => 'Email already verified.'], 200);
    }
}
