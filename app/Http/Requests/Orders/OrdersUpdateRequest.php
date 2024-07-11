<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrdersUpdateRequest extends FormRequest
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
            'payment_id' => 'required|exists:payments,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'totalAmount' => 'required|numeric',
            'token' => 'required|string',
            'number' => 'required|string',
            'state' => 'sometimes|string',

        ];
    }
}
