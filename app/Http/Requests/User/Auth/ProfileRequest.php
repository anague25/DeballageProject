<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => 'sometimes|email|max:255|unique:users,email,' . request()->id,
            'password' => 'sometimes|confirmed|min:6',
            'firstName' => 'sometimes|string',
            'lastName' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'cniRecto' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:2042',
            'cniVerso' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:2042',
            'gender' => 'sometimes|string|in:M,W',
            'state' => 'sometimes|string|in:init,enable,desable',
            'role' => 'sometimes|string|in:admin,user',
            'profile' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:2042',
        ];
    }
}
