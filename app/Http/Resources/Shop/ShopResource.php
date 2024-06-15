<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
            'profile' => $this->profile,
            'cover' => $this->cover,
            'user' => $this->user,
            'categories' => $this->categories,
            'cities' => $this->cities,
            'products' => $this->products,

        ];
    }
}
