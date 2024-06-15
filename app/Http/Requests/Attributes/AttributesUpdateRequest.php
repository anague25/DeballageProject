<?php

namespace App\Http\Requests\Attributes;

use Illuminate\Foundation\Http\FormRequest;

class AttributesUpdateRequest extends FormRequest
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
    public function rules()
    {
        $attributeId = $this->route('attribute');

        return [
            'name' => 'required|string|unique:attributes,name,' . $attributeId->id,
        ];
    }
}
