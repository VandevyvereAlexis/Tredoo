<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'nullable|integer|min:1|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Le fichier doit être une image valide.',
            'image.mimes' => 'L\'image doit être au format jpeg, png, jpg ou gif.',
            'image.max'   => 'L\'image ne doit pas dépasser 2 Mo.',

            'position.integer' => 'La position doit être un entier.',
            'position.min'     => 'La position doit être au moins 1.',
            'position.max'     => 'La position ne peut pas dépasser 10.',
        ];
    }
}
