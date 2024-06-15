<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\Auth\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProfileRequest $request,User $user)
    {
        $data = $request->validated();
        
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        if(isset($data['profile'])){
            $data['profile'] = $data['profile']->store('images/users', 'public');
        }
        if(isset($data['cniRecto'])){
            $data['cniRecto'] = $data['cniRecto']->store('images/users', 'public');
        }

        if(isset($data['cniVerso'])){
            $data['cniVerso'] = $data['cniVerso']->store('images/users', 'public');
        }
        $user->update($data);
        return response()->json([
            'message'=>'profile updated with successfully',
            'user'=>$user,
        ],200);
        
    }
}
