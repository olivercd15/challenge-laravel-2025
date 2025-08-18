<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name' => 'User name is required.',
            'email' => 'Valid email is required.',
            'password' => 'Password must be greater than 6 characters',
        ];
    }
}
