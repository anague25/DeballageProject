<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'required|string',
            'cniRecto' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:2042',
            'cniVerso' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:2042',
            'gender' => 'required|string|in:M,W',
            'state' => 'sometimes|string|in:init,enable,desable',
            'role' => 'sometimes|string|in:admin,user',
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif|max:2042',
        ];
    }
}
