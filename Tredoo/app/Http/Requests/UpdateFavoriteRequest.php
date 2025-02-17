<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFavoriteRequest extends FormRequest
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
            'user_id'    => 'sometimes|exists:users,id',
            'annonce_id' => 'sometimes|exists:annonces,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',

            'annonce_id.exists' => 'L\'annonce spécifiée n\'existe pas.',
        ];
    }
}
