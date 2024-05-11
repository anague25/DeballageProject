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
        return $this->belongsToMany(City::class);
    }
}
