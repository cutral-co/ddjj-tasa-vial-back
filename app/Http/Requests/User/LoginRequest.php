<?php

namespace App\Http\Requests\User;

use App\Http\Requests\TraitRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use TraitRequest;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cuit' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'cuit.required' => 'Cuit es requerido',
            'password.required' => 'La contrasñea es requerida',
        ];
    }
}
