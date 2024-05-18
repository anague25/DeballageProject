<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'user_id' => $this->user_id,
            'number' => $this->number,
            'total_amount' => $this->total_amount,
            'state' => $this->state,
            'order_items' => new OrdersCollection($this->whenLoaded('orderItems')),
        ];
    }
}
