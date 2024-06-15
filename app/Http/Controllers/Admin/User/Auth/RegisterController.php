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
        $data['profile'] = $data['profile']->store('images/users', 'public');
        if(isset($data['cniRecto'])){
            $data['cniRecto'] = $data['cniRecto']->store('images/users', 'public');
        }

        if(isset($data['cniVerso'])){
            $data['cniVerso'] = $data['cniVerso']->store('images/users', 'public');
        }
        // dd($data);

        $user = User::create($data);
        //verification d'email
        if (!$data['state']) {
            Mail::to($user)->send(new EmailVerification($user));
        }

        return response()->json(['message' => 'User registered successfully. Please verify your email.'], 201);
    }
}
