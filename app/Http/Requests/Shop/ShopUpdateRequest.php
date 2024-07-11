<?php

namespace App\Http\Requests\Shop;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'state' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2042',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2042',
            'info' => 'nullable|string',
            'city_fields.*.city_id' => 'required|exists:cities,id',
            'city_fields.*.neighborhood_id' => 'required|exists:neighborhoods,id',
            'category_fields.*.category_id' => 'required|exists:categories,id',
            'category_fields.*.subCategory_id' => 'required|exists:categories,id',
        ];
    }


    public function messages(): array
    {
        return [
            'city_fields.*.city_id.required' => 'The city field is required',
            'city_fields.*.neighborhood_id.required' => 'The neighborhood field is required',
            'category_fields.*.subCategory_id.required' => 'The subCategory field is required',
            'category_fields.*.category_id.required' => 'The category field is required',
        ];
    }
}
