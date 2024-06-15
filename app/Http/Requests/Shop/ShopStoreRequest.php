<?php

namespace App\Http\Requests\Shop;

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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'state' => 'required|string|in:enable,desable,init',
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif|max:2042',
            'cover' => 'required|image|mimes:jpg,png,jpeg,gif|max:2042',
            'city_fields.*.city_id' => 'required|exists:cities,id',
            'city_fields.*.neighborhood_id' => 'required|exists:neighborhoods,id',
            'category_fields.*.category_id' => 'required|exists:categories,id',
            'category_fields.*.subCategory_id' => 'required|exists:categories,id',
        ];
    }



}
