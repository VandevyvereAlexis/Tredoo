<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConversationRequest extends FormRequest
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
            'annonce_id' => 'sometimes|exists:annonces,id',
            'buyer_id'   => 'sometimes|exists:users,id',
            'seller_id'  => 'sometimes|exists:users,id',
            'status'     => 'sometimes|in:ouverte,fermee',
        ];
    }

    public function messages(): array
    {
        return [
            'annonce_id.exists' => 'L\'annonce spécifiée n\'existe pas.',

            'buyer_id.exists'   => 'L\'acheteur spécifié n\'existe pas.',

            'seller_id.exists'  => 'Le vendeur spécifié n\'existe pas.',
            
            'status.in'         => 'Le statut doit être "ouverte" ou "fermée".',
        ];
    }
}
