<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'state',
        'profile',
        'cover',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function cities()
    {
        return $this->belongsToMany(City::class, 'shop_city', 'shop_id', 'city_id')
            ->withPivot('neighborhood_id');
    }

    public function neighborhoods()
    {
        return $this->belongsToMany(Neighborhood::class, 'shop_city', 'shop_id', 'neighborhood_id')
            ->withPivot('city_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_shop')
            ->withPivot('subCategory_id');
    }

    // Relation pour les avis (Review)
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // Relation pour les favoris (Favorite)
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }



    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,
            Product::class,
            'shop_id',      // Clé étrangère dans Product pour relier à Shop
            'id',           // Clé locale dans Shop
            'id',           // Clé locale dans Product pour relier à OrderItem
            'product_id'    // Clé étrangère dans OrderItem pour relier à Product
        )
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->distinct();
    }


    // Dans le modèle Shop.php
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Order::class, 'id', 'order_id', 'id', 'id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.shop_id', '=', $this->id)
            ->distinct();
    }
}
