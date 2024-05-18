<?php

namespace App\Http\Requests\Review;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
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
            'reviewable_id' => 'required|integer',
            'reviewable_type' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
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
