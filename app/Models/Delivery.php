<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'city',
        'email',
        'phone',
        'lastName',
        'firstName',
        'description',
        'neighborhood',
        'address',
        'state',

    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
