<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:roles,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ "Nom" est obligatoire.',
            'name.string'   => 'Le champ "Nom" doit être une chaîne de caractères valide.',
            'name.max'      => 'Le champ "Nom" ne doit pas dépasser 100 caractères.',
            'name.unique'   => 'Le champ "Nom" doit être unique, ce rôle existe déjà.',
        ];
    }
}
