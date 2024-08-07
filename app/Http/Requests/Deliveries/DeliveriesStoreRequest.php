<?php

namespace App\Http\Requests\Deliveries;

use Illuminate\Foundation\Http\FormRequest;

class DeliveriesStoreRequest extends FormRequest
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
            'city' => 'required|string',
            'neighborhood' => 'required|string',
            'phone' => 'required|string',
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'description' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'order_id' => 'required|exists:orders,id',
            'state' => 'sometimes|string|in:pending,delivered,cancelled',
        ];
    }
}
