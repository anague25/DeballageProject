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
        'state',
        'profile',
        'cover',
        'info',
    ];
}
