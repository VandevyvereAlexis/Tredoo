<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarModelRequest extends FormRequest
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
            'name'     => 'required|string|max:100|unique:car_models,name',
            'brand_id' => 'required|exists:brands,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du modèle de voiture est requis.',
            'name.string'   => 'Le nom du modèle de voiture doit être une chaîne de caractères.',
            'name.max'      => 'Le nom du modèle de voiture ne peut pas dépasser 100 caractères.',
            'name.unique'   => 'Ce nom de modèle de voiture existe déjà.',

            'brand_id.required' => 'La marque associée est requise.',
            'brand_id.exists'   => 'La marque sélectionnée est invalide.',
        ];
    }
}
