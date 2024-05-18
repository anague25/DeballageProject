<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city_id',
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'shop_city', 'neighborhood_id', 'shop_id')
                    ->withPivot('city_id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'shop_city', 'neighborhood_id', 'city_id')
                    ->withPivot('shop_id');
    }
}
