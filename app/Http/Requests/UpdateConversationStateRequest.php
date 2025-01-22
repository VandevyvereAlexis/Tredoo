<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConversationStateRequest extends FormRequest
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
            'conversation_id' => 'sometimes|exists:conversations,id',
            'user_id'         => 'sometimes|exists:users,id',
            'status'          => 'sometimes|in:visible,supprimee,archivee',
        ];
    }

    public function messages(): array
    {
        return [
            'conversation_id.exists' => 'La conversation spécifiée n\'existe pas.',
            'user_id.exists'         => 'L\'utilisateur spécifié n\'existe pas.',
            'status.in'              => 'Le statut doit être l\'une des valeurs suivantes : active, inactive, archived.',
        ];
    }
}
