<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $filable = [
        'name',
        'description',
        'status',
        'profile',
        'cover',
        'user_id',
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

    public function products()
    {
        return $this->hasMany(Product::class);
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
}
