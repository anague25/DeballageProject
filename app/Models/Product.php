<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'image',
        'quantity',
        'price',
        'description',
        'status',

    ];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
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
        return $this->belongsToMany(Order::class);
    }
}
