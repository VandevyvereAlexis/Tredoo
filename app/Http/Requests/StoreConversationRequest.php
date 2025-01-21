<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreConversationRequest extends FormRequest
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
            'annonce_id' => 'required|exists:annonces,id',
            'buyer_id'   => 'required|exists:users,id|different:seller_id',
            'seller_id'  => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'annonce_id.required' => 'Le champ annonce est obligatoire.',
            'annonce_id.exists'   => 'L\'annonce sélectionnée n\'existe pas.',

            'buyer_id.required'  => 'Le champ acheteur est obligatoire.',
            'buyer_id.exists'    => 'L\'acheteur sélectionné n\'existe pas.',
            'buyer_id.different' => 'L\'acheteur doit être différent du vendeur.',

            'seller_id.required' => 'Le champ vendeur est obligatoire.',
            'seller_id.exists'   => 'Le vendeur sélectionné n\'existe pas.',
        ];
    }
}
