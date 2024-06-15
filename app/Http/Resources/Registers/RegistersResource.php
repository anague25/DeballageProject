<?php

namespace App\Http\Resources\Registers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistersResource extends JsonResource
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
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'profile'=>$this->profile,
            'phone'=>$this->phone,
            'gender'=>$this->gender,
            'state'=>$this->state,
            'email'=>$this->email,
            'role'=>$this->role,
        ];
    }
}
