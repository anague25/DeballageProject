<?php

namespace App\Http\Requests\Review;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
            'reviewable_type' => [
                'required',
                'string',
                Rule::in(['App\\Models\Product', 'App\\Models\\Shop']),
            ],
            'reviewable_id' => 'required|integer|exists:' . $this->getReviewableTableName() . ',id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ];
    }


    /**
     * Get the table name for the reviewable type.
     *
     * @return string
     */
    private function getReviewableTableName()
    {
        $reviewableType = $this->input('reviewable_type');
        // Convertir le type de modèle en nom de table
        switch ($reviewableType) {
            case 'App\\Models\\Product':
                return 'products';
            case 'App\\Models\\Shop':
                return 'shops';
            default:
                return 'unknown';
        }
    }
}
