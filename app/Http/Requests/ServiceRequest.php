<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'available' => ['boolean']
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El nombre es obligatorio',
            'price.required' => 'El precio es obligatorio',
            'price.numeric' => 'El precio no es válido'
        ];
    }
}
