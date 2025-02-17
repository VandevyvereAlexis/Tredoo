<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'content' => 'sometimes|required|string|max:1000',
            'read'    => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu du message est requis.',
            'content.string'   => 'Le contenu doit être une chaîne de caractères.',
            'content.max'      => 'Le contenu ne peut pas dépasser 1000 caractères.',
            'read.boolean'     => 'Le champ "lu" doit être un booléen (true ou false).',
        ];
    }
}
