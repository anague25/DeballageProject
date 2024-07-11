<?php

namespace App\Http\Requests\OrderItems;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|numeric',

            'city' => 'required|string',
            'neighborhood' => 'required|string',
            'phone' => 'required|string',
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'description' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ];
    }
}
