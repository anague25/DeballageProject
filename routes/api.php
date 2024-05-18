<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Shop\ShopController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Cities\CitiesController;
use App\Http\Controllers\Admin\User\Auth\AuthController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\User\Auth\LoginController;
use App\Http\Controllers\Admin\User\Auth\LogoutController;
use App\Http\Controllers\Admin\Messages\MessagesController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\User\Auth\RegisterController;
use App\Http\Controllers\Admin\Favorites\FavoritesController;
use App\Http\Controllers\Admin\Attributes\AttributesController;
use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Deliveries\DeliveriesController;
use App\Http\Controllers\Admin\OrderItems\OrderItemsController;
use App\Http\Controllers\Admin\Properties\PropertiesController;
use App\Http\Controllers\Admin\User\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\User\Auth\PasswordResetController;
use App\Http\Controllers\Admin\Neighborhoods\NeighborhoodsController;
use App\Http\Controllers\Admin\Notifications\NotificationsController;
use App\Http\Controllers\Admin\ProductImages\ProductImagesController;

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

//manage the categories
Route::apiResource('/categories', CategoriesController::class)->except('update');
Route::post('/categories/{category}', [CategoriesController::class, 'update']);


//manage the attributes
Route::apiResource('/attributes', AttributesController::class);

//manage the cities
Route::apiResource('/cities', CitiesController::class);

//manage the deliveries
Route::apiResource('/deliveries', DeliveriesController::class);

//manage the favorites
Route::apiResource('/favorites', FavoritesController::class);

//manage the messages
Route::apiResource('/messages', MessagesController::class);

//manage the neighbordhood
Route::apiResource('/neighbordhood', NeighborhoodsController::class);

//manage the notifications
Route::apiResource('/notifications', NotificationsController::class);

//manage the orders
Route::get('/orders/associate/{token}', [OrderController::class, 'associateOrder']);
Route::apiResource('/orders', OrderController::class);

//manage the orderItems
Route::apiResource('/order-items', OrderItemsController::class);

//manage the products 
Route::apiResource('/products', ProductsController::class);

//manage the properties
Route::apiResource('/properties', PropertiesController::class);

//manage the reviews
Route::apiResource('/reviews', ReviewsController::class);

//manage the settings
Route::apiResource('/settings', SettingsController::class);

//manage the shops
Route::apiResource('/shops', ShopController::class);

//manage the Shop
Route::apiResource('/productImages', ProductImagesController::class)->only('delete', 'show');
Route::post('productImages/{product}', [ProductImagesController::class, 'store']);
Route::post('productImages/{productImage}', [ProductImagesController::class, 'update']);
Route::get('productImages/{product}', [ProductImagesController::class, 'update']);


