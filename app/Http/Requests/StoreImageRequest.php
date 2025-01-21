<?php

namespace App\Http\Requests;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'annonce_id'  => [
            'required',
            'exists:annonces,id',
            function ($attribute, $value, $fail) {
                $existingImagesCount = Image::where('annonce_id', $value)->count();
                $newImagesCount = count($this->input('images', []));

                if ($existingImagesCount + $newImagesCount > 10) {
                    $fail('Maximum de 10 images atteint pour cette annonce.');
                }
            },
        ],
        'images'      => 'required|array|min:1|max:10',
        'images.*'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'positions'   => 'nullable|array',
        'positions.*' => 'nullable|integer|min:1|max:10|distinct',
        ];
    }

    public function messages(): array
    {
        return [
            'annonce_id.required' => 'Le champ "ID de l\'annonce" est obligatoire.',
            'annonce_id.exists'   => 'L\'annonce spécifiée n\'existe pas.',

            'images.required'     => 'Veuillez télécharger au moins une image.',
            'images.array'        => 'Les images doivent être fournies sous forme de tableau.',
            'images.min'          => 'Vous devez télécharger au moins une image.',
            'images.max'          => 'Vous ne pouvez pas télécharger plus de 10 images.',

            'images.*.required'   => 'Chaque image est obligatoire.',
            'images.*.image'      => 'Chaque fichier doit être une image valide.',
            'images.*.mimes'      => 'Les images doivent être au format jpeg, png, jpg ou gif.',
            'images.*.max'        => 'Chaque image ne doit pas dépasser 2 Mo.',

            'positions.array'     => 'Les positions doivent être fournies sous forme de tableau.',
            
            'positions.*.integer' => 'Chaque position doit être un entier.',
            'positions.*.min'     => 'Chaque position doit être d\'au moins 1.',
            'positions.*.max'     => 'Chaque position ne doit pas dépasser 10.',
            'positions.*.distinct'=> 'Chaque position doit être unique.',
        ];
    }
}
