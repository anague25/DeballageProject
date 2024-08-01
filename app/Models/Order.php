<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'token',
        'totalAmount',
        'state',
        'payment_id',
        'number',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($order) {
    //         $order->token = 'CMD-' . Str::uuid();
    //     });
    // }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveries()
    {
        return $this->hasOne(Delivery::class);
    }



    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
