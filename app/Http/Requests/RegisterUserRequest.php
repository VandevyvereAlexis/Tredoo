<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            'last_name'     => 'required|string|max:50',
            'first_name'    => 'required|string|max:50',
            'username'      => 'required|string|max:50|unique:users,username',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required' => 'Le champ "Nom" est obligatoire.',
            'last_name.string'   => 'Le champ "Nom" doit être une chaîne de caractères.',
            'last_name.max'      => 'Le champ "Nom" ne doit pas dépasser 50 caractères.',

            'first_name.required' => 'Le champ "Prénom" est obligatoire.',
            'first_name.string'   => 'Le champ "Prénom" doit être une chaîne de caractères.',
            'first_name.max'      => 'Le champ "Prénom" ne doit pas dépasser 50 caractères.',

            'username.required' => 'Le champ "Nom d\'utilisateur" est obligatoire.',
            'username.string'   => 'Le champ "Nom d\'utilisateur" doit être une chaîne de caractères.',
            'username.max'      => 'Le champ "Nom d\'utilisateur" ne doit pas dépasser 50 caractères.',
            'username.unique'   => 'Ce nom d\'utilisateur est déjà utilisé.',

            'email.required' => 'Le champ "Email" est obligatoire.',
            'email.email'    => 'Le champ "Email" doit être une adresse email valide.',
            'email.max'      => 'Le champ "Email" ne doit pas dépasser 255 caractères.',
            'email.unique'   => 'Cette adresse email est déjà utilisée.',

            'password.required'  => 'Le mot de passe est requis.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min'       => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.mixedCase' => 'Le mot de passe doit contenir des lettres minuscules et majuscules.',
            'password.letters'   => 'Le mot de passe doit contenir au moins une lettre.',
            'password.numbers'   => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols'   => 'Le mot de passe doit contenir au moins un caractère spécial.',

            'profile_image.image' => 'Le fichier doit être une image.',
            'profile_image.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou gif.',
            'profile_image.max'   => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
