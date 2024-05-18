<?php

namespace App\Http\Requests\OrderItems;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemsUpdateRequest extends FormRequest
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
            '*.id' => 'required|exists:order_items,id',
            '*.product_id' => 'sometimes|exists:products,id',
            '*.price' => 'sometimes|numeric',
            '*.quantity' => 'sometimes|numeric',
        ];
    }
}
