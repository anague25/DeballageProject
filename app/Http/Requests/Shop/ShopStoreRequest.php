<?php

namespace App\Http\Requests\Shop;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ShopStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'state' => 'required|string',
            'profile' => 'required|string',
            'cover' => 'nullable|string',
            'info' => 'nullable|string',
            'city_fields.*.city_id' => 'required|exists:cities,id',
            'city_fields.*.neighborhood_id' => 'required|exists:neighborhoods,id',
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
            'user_id' => Auth::id()
        ]);
    }
}
