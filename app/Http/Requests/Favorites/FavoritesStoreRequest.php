<?php

namespace App\Http\Requests\Favorites;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class FavoritesStoreRequest extends FormRequest
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
            'favoritable_type' => 'required|in:App\\Models\\Product,App\\Models\\Shop',
            'favoritable_id' => 'required|exists:' . $this->getTableName() . ',id',
        ];
    }



    /**
     * Obtenez le nom de la table en fonction de l'entrée favoritable_type.
     *
     * @return string
     */
    protected function getTableName(): string
    {
        $type = $this->input('favoritable_type');
        // dd($type);
        return (new $type)->getTable();
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
