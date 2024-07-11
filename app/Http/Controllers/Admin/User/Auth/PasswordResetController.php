<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordLink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Auth\LinkEmailRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(LinkEmailRequest $request)
    {
        $url = URL::temporarySignedRoute('password.reset', now()->addMinute(30), ['email' => $request->validated('email')]);

        $url = str_replace(env('APP_URL'), env('FRONTEND_URL'), $url);

        Mail::to($request->validated('email'))->send(new ResetPasswordLink($url));

        return response()->json([
            'message' => 'reset password link sent on your message'
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::whereEmail($request->validated('email'))->first();
        if (!$user) {
            return response()->json([
                "message" => "User Not Found!",
                "email" => $request->validated('email')

            ], 404);
        }

        $user->update(['password' => Hash::make($request->validated('password'))]);

        return response()->json([
            "message" => "Password reset successfully!"

        ], 200);
    }
}
