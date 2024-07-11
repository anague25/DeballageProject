<?php

namespace App\Http\Requests\Orders;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class OrdersStoreRequest extends FormRequest
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


    /**
     * Prépare les données pour validation.
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        // Ajouter l'ID de l'utilisateur authentifié aux données de la requête
        $this->merge([
            'token' => hash('sha256', Str::random(10)),
            'number' => 'CMD-' . (string) Str::uuid(),
        ]);
    }
}
