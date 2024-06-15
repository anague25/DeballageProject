<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'description'=>$this->description,
            'image'=>$this->image,
            'images'=>$this->images,
            'shop'=>$this->shop,
            'category'=>$this->category,
            'attributes'=>$this->attributes,
        ];
    }
}
