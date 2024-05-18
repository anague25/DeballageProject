<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'order_id',
        
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
