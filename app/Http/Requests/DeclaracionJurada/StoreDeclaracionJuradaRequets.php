<?php

namespace App\Http\Requests\DeclaracionJurada;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeclaracionJuradaRequets extends FormRequest
{
    use \App\Http\Requests\TraitRequest;
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
            'razon_social' => 'required',
            'periodo' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'razon_social.required' => 'Razon social es requerida',

            'periodo.required' => 'Período es requerido',
            'periodo.regex' => 'Período debe tener el formato YYYY-MM, donde YYYY es un año válido y MM es un mes válido del 01 al 12',
        ];
    }
}
