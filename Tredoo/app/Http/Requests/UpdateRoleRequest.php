<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:roles,name,' . $this->role->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du rôle est requis.',
            'name.string'   => 'Le nom doit être une chaîne de caractères.',
            'name.max'      => 'Le nom ne peut pas dépasser 100 caractères.',
            'name.unique'   => 'Ce nom de rôle existe déjà.',
        ];
    }
}
