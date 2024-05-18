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

            'total_amount' => 'required|numeric',
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
            'user_id' => auth()->check() ? auth()->id() : null,
            'token' => hash('sha256', Str::random(60)),
            'number' => 'CMD-' . (string) Str::uuid(),
        ]);
    }
}
