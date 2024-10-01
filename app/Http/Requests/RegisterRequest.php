<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordValidation;

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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', PasswordValidation::min(8)],
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El nombre es obligatorio',
            'email' => 'El correo es obligatorio',
            'email.unique' => 'El usuario ya esta sido regsitrado',
            'password' => 'La contraseña debe tener al menos 8 caracteres'
        ];
    }
}
