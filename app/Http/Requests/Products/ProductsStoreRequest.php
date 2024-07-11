<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsStoreRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array', // Ajoutez cette règle
            'images.*' => 'required|image|mimes:jpeg,png,gif,jpg|max:3080',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'shop_id' => 'required|exists:shops,id',
            'attribute_fields.*.attribute_id' => 'required|exists:attributes,id',
            'attribute_fields.*.property_id' => 'required|exists:properties,id',
        ];
    }


    public function messages(): array
    {
        return [
            'attribute_fields.*.attribute_id.required' => 'The attribute field is required',
            'attribute_fields.*.property_id.required' => 'The property field is required',

        ];
    }
}
