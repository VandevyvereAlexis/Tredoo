<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'conversation_id' => 'required|exists:conversations,id',
            'user_id'         => 'required|exists:users,id',
            'content'         => 'required|string|max:1000',
            'read'            => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'conversation_id.required' => 'Le champ "ID de la conversation" est obligatoire.',
            'conversation_id.exists'   => 'La conversation spécifiée n\'existe pas.',

            'user_id.required' => 'Le champ "ID de l\'utilisateur" est obligatoire.',
            'user_id.exists'   => 'L\'utilisateur spécifié n\'existe pas.',

            'content.required' => 'Le champ "Contenu" est obligatoire.',
            'content.string'   => 'Le contenu doit être une chaîne de caractères.',

            'content.max' => 'Le contenu ne doit pas dépasser 1000 caractères.',
            
            'read.boolean' => 'Le champ "Lu" doit être un booléen.',
        ];
    }
}
