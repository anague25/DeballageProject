<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];


    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'shop_city', 'city_id', 'shop_id')
                    ->withPivot('neighborhood_id');
    }

    public function pivotNeighborhoods()
    {
        return $this->belongsToMany(Neighborhood::class, 'shop_city', 'city_id', 'neighborhood_id')
                    ->withPivot('shop_id');
    }



    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}
