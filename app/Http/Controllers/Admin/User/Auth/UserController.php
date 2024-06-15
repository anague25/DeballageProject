<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Registers\RegistersResource;
use App\Http\Resources\Registers\RegistersCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  new RegistersCollection(User::paginate(10));
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return response()->json(['users' => User::all()], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['user' => $user], 201);
    }


   /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $shop =  $user->shop;
        $shop?->products()->delete();
        $user->shop()?->delete();
        // dd('ddd');
        if ($user->profile) {
            Storage::disk('public')->delete($user->profile);
        }
        if ($user->cniRecto) {
            Storage::disk('public')->delete($user->cniRecto);
        }
        if ($user->cniVerso) {
            Storage::disk('public')->delete($user->cniVerso);
        }
        $user->delete();
    }
}
