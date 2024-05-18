<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Services\Cities\CitiesServices;
use App\Services\Orders\OrdersServices;
use Illuminate\Support\ServiceProvider;
use App\Services\Messages\MessagesServices;
use App\Services\Products\ProductsServices;
use App\Contracts\Cities\CityServiceContract;
use App\Services\Favorites\FavoritesServices;
use App\Contracts\Orders\OrderServiceContract;
use App\Services\Attributes\AttributesServices;
use App\Services\Categories\CategoriesServices;
use App\Services\Deliveries\DeliveriesServices;
use App\Services\OrderItems\OrderItemsServices;
use App\Contracts\Messages\MessageServiceContract;
use App\Contracts\Products\ProductServiceContract;
use App\Contracts\Favorites\FavoriteServiceContract;
use App\Contracts\Categories\CategoryServiceContract;
use App\Contracts\Deliveries\DeliveryServiceContract;
use App\Services\Neighborhoods\NeighborhoodsServices;
use App\Services\Notifications\NotificationsServices;
use App\Services\ProductImages\ProductImagesServices;
use App\Contracts\Attributes\AttributeServiceContract;
use App\Contracts\OrderItems\OrderItemServiceContract;
use App\Contracts\Neighborhoods\NeighborhoodServiceContract;
use App\Contracts\Notifications\NotificationServiceContract;
use App\Contracts\ProductImages\ProductImageServiceContract;
use App\Contracts\Reviews\ReviewServiceContract;
use App\Contracts\Settings\SettingServiceContract;
use App\Contracts\Shop\ShopServiceContract;
use App\Services\Reviews\ReviewsServices;
use App\Services\Settings\SettingsServices;
use App\Services\Shop\ShopServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AttributeServiceContract::class, AttributesServices::class);

        $this->app->bind(CategoryServiceContract::class, CategoriesServices::class);

        $this->app->bind(CityServiceContract::class, CitiesServices::class);

        $this->app->bind(DeliveryServiceContract::class, DeliveriesServices::class);

        $this->app->bind(FavoriteServiceContract::class, FavoritesServices::class);

        $this->app->bind(MessageServiceContract::class, MessagesServices::class);

        $this->app->bind(NeighborhoodServiceContract::class, NeighborhoodsServices::class);

        $this->app->bind(NotificationServiceContract::class, NotificationsServices::class);

        $this->app->bind(OrderItemServiceContract::class, OrderItemsServices::class);

        $this->app->bind(OrderServiceContract::class, OrdersServices::class);

        $this->app->bind(ProductImageServiceContract::class, ProductImagesServices::class);

        $this->app->bind(ProductServiceContract::class, ProductsServices::class);

        $this->app->bind(ReviewServiceContract::class, ReviewsServices::class);

        $this->app->bind(SettingServiceContract::class, SettingsServices::class);

        $this->app->bind(ShopServiceContract::class, ShopServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
