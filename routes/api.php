<?php

use App\Http\Controllers\Admin\Shop\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\Auth\AuthController;
use App\Http\Controllers\Admin\User\Auth\LoginController;
use App\Http\Controllers\Admin\User\Auth\LogoutController;
use App\Http\Controllers\Admin\User\Auth\PasswordResetController;
use App\Http\Controllers\Admin\User\Auth\RegisterController;
use App\Http\Controllers\Admin\User\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentification
Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::post('register', RegisterController::class);
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset')->middleware('signed');
Route::post('email/verify/send', [VerifyEmailController::class, 'sendMail']);
Route::post('email/verify', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verify-email');

//manage the Shop
Route::apiResource('/shop', ShopController::class);
