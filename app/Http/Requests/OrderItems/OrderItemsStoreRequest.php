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
            '*.product_id' => 'required|exists:products,id',
            '*.price' => 'required|numeric',
            '*.quantity' => 'required|numeric',
        ];
    }
}
