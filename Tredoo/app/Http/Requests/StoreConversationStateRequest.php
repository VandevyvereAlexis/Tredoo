<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversationStateRequest extends FormRequest
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
            'status'          => 'nullable|in:visible,supprimee,archivee',
        ];
    }

    public function messages(): array
    {
        return [
            'conversation_id.required' => 'Le champ "ID de la conversation" est obligatoire.',
            'conversation_id.exists'   => 'La conversation spécifiée n\'existe pas.',

            'user_id.required' => 'Le champ "ID de l\'utilisateur" est obligatoire.',
            'user_id.exists'   => 'L\'utilisateur spécifié n\'existe pas.',

            'status.in' => 'Le statut doit être l\'une des valeurs suivantes : visible, supprimée ou archivée.',
        ];
    }
}
