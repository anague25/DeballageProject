<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['attribute_id', 'name'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'property_id', 'product_id');
    }
}
