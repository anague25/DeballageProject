<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdateRequest extends FormRequest
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
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'attribute_fields.*.attribute_id' => 'required|exists:attributes,id',
            'attribute_fields.*.property_id' => 'required|exists:properties,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
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
