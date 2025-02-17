<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'role_id'       => 'sometimes|exists:roles,id',
            'last_name'     => 'sometimes|string|max:50',
            'first_name'    => 'sometimes|string|max:50',
            'username'      => 'sometimes|string|max:50|unique:users,username,' . $this->user->id,
            'email'         => 'sometimes|email|max:255|unique:users,email,' . $this->user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',

            'last_name.string' => 'Le champ "Nom" doit être une chaîne de caractères.',
            'last_name.max'    => 'Le champ "Nom" ne doit pas dépasser 50 caractères.',

            'first_name.string' => 'Le champ "Prénom" doit être une chaîne de caractères.',
            'first_name.max'    => 'Le champ "Prénom" ne doit pas dépasser 50 caractères.',

            'username.string' => 'Le champ "Nom d\'utilisateur" doit être une chaîne de caractères.',
            'username.max'    => 'Le champ "Nom d\'utilisateur" ne doit pas dépasser 50 caractères.',
            'username.unique' => 'Le nom d\'utilisateur est déjà utilisé.',

            'email.email'    => 'Le champ "Email" doit être une adresse email valide.',
            'email.max'      => 'Le champ "Email" ne doit pas dépasser 255 caractères.',
            'email.unique'   => 'L\'adresse email est déjà utilisée.',

            'profile_image.image' => 'Le fichier téléchargé doit être une image.',
            'profile_image.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou gif.',
            'profile_image.max'   => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
