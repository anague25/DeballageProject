<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Shop\ShopController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Cities\CitiesController;
use App\Http\Controllers\Admin\User\Auth\UserController;
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
use App\Http\Controllers\Admin\Payments\PaymentsController;
use App\Http\Controllers\Admin\ProductImages\ProductImagesController;
use App\Http\Controllers\Admin\User\Auth\ProfileController;
use App\Http\Controllers\Admin\User\Auth\UserAuthController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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


// users
Route::prefix('users')->group(function () {
    Route::post('/login', LoginController::class)->name('login');

    //Authentification
    Route::post('/logout', LogoutController::class);
    Route::post('/register', RegisterController::class);
    Route::get('/auth', UserAuthController::class);
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
    Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset')->middleware('signed');
    Route::post('/email/verify/send', [VerifyEmailController::class, 'sendMail']);
    Route::post('/email/verify', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verify-email');

    Route::get('/all', [UserController::class, 'all']);
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::post('/{user}', ProfileController::class);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});



//manage the categories

Route::get('/productsByCategory/{category}', [CategoriesController::class, 'productsByCategory']);
Route::get('/user-categories', [CategoriesController::class, 'getCategoriesUser'])->middleware('auth:api');
Route::get('/categories/all', [CategoriesController::class, 'all']);
Route::apiResource('/categories', CategoriesController::class)->except('update');
Route::post('/categories/{category}', [CategoriesController::class, 'update']);


//manage the attributes
Route::get('/user-attributes', [AttributesController::class, 'getAttributeUser'])->middleware('auth:api');
Route::get('/attributes/all', [AttributesController::class, 'all']);
Route::apiResource('/attributes', AttributesController::class);

//manage the cities
Route::get('/cities/all', [CitiesController::class, 'all']);
Route::apiResource('/cities', CitiesController::class);


//manage the favorites
Route::delete('/remove-favorite/{id}', [FavoritesController::class, 'removeFavorite']);
Route::apiResource('/favorites', FavoritesController::class);


//manage the messages
Route::apiResource('/messages', MessagesController::class);

//manage the neighbordhood

Route::get('/neighborhoods/all', [NeighborhoodsController::class, 'all']);
Route::apiResource('/neighborhoods', NeighborhoodsController::class);

//manage the notifications
Route::apiResource('/notifications', NotificationsController::class);

//manage the orders
Route::get('/orders-shop', [OrderController::class, 'getOrdersByShop'])->middleware('auth:sanctum');
Route::get('/orders/associate/{token}', [OrderController::class, 'associateOrder']);
Route::middleware('auth:sanctum')->get('/user/orders', [OrderController::class, 'getUserOrders']);
Route::apiResource('/orders', OrderController::class);
//manage payments
Route::middleware('auth:sanctum')->get('/shop-payments', [PaymentsController::class, 'getPaymentsByShop']);
Route::middleware('auth:sanctum')->get('/user/payments', [PaymentsController::class, 'getUserPaymentssWithDetails']);
Route::apiResource('/payments', PaymentsController::class);

//manage the orderItems
Route::post('/order-items/{order}', [OrderItemsController::class, 'store']);
Route::apiResource('/order-items', OrderItemsController::class)->except('store');
//manage the deliveries
Route::apiResource('/deliveries', DeliveriesController::class);

//manage the products 
Route::get('/products/all', [ProductsController::class, 'all']);
Route::apiResource('/products', ProductsController::class)->except('update');
Route::post('/products/{product}', [ProductsController::class, 'update']);

//manage the properties
Route::get('/user-properties', [PropertiesController::class, 'getAttributeUser'])->middleware('auth:api');
Route::get('/properties/all', [PropertiesController::class, 'all']);
Route::apiResource('/properties', PropertiesController::class);

//manage the reviews

Route::get('/all-reviews', [ReviewsController::class, 'getReviews']);
Route::apiResource('/reviews', ReviewsController::class);

//manage the settings
Route::apiResource('/settings', SettingsController::class);

//manage the shops
Route::get('/shops/all', [ShopController::class, 'all']);
Route::apiResource('/shops', ShopController::class)->except('update');
Route::post('/shops/{shop}', [ShopController::class, 'update']);

//manage the Shop
Route::get('productImages/{product}', [ProductImagesController::class, 'index']);
Route::post('productImages/{product}', [ProductImagesController::class, 'store']);
Route::post('productImages/{productImage}', [ProductImagesController::class, 'update']);
Route::apiResource('/productImages', ProductImagesController::class)->only('destroy', 'show');
