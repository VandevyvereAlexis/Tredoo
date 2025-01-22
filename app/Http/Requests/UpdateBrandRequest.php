<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:100|unique:brands,name,' . $this->brand->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la marque est requis.',
            'name.string'   => 'Le nom de la marque doit être une chaîne de caractères.',
            'name.max'      => 'Le nom de la marque ne peut pas dépasser 100 caractères.',
            'name.unique'   => 'Ce nom de marque existe déjà.',
        ];
    }
}
