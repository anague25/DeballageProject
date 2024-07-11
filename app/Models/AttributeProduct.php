<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeProduct extends Pivot
{
    protected $table = 'attribute_product'; // Définition du nom de la table
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
