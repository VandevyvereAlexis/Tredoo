<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnonceRequest extends FormRequest
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
            'user_id'                 => 'sometimes|exists:users,id',
            'brand_id'                => 'sometimes|exists:brands,id',
            'car_model_id'            => 'sometimes|exists:car_models,id',
            'title'                   => 'sometimes|string|max:150|unique:annonces,title,' . $this->annonce->id,
            'sold'                    => 'sometimes|boolean',
            'visible'                 => 'sometimes|boolean',
            'first_hand'              => 'sometimes|boolean',
            'price'                   => 'sometimes|numeric|min:1|max:10000000',
            'mileage'                 => 'sometimes|integer|min:1|max:999999',
            'fiscal_power'            => 'sometimes|integer|min:1|max:1500',
            'horsepower'              => 'sometimes|integer|min:1|max:150',
            'first_registration_date' => 'sometimes|date',
            'city'                    => 'sometimes|string|max:100',
            'postal_code'             => 'sometimes|string|size:5',
            'latitude'                => 'nullable|numeric',
            'longitude'               => 'nullable|numeric',
            'description'             => 'sometimes|string',
            'fuel'                    => 'sometimes|in:' . implode(',', \App\Models\Annonce::FUELS),
            'transmission'            => 'sometimes|in:' . implode(',', \App\Models\Annonce::TRANSMISSIONS),
            'type'                    => 'sometimes|in:' . implode(',', \App\Models\Annonce::TYPES),
            'doors'                   => 'sometimes|in:' . implode(',', \App\Models\Annonce::DOORS),
            'seats'                   => 'sometimes|in:' . implode(',', \App\Models\Annonce::SEATS),
            'color'                   => 'sometimes|in:' . implode(',', \App\Models\Annonce::COLORS),
            'condition'               => 'sometimes|in:' . implode(',', \App\Models\Annonce::CONDITIONS),
            'crit_air'                => 'nullable|in:' . implode(',', \App\Models\Annonce::CRITAIRS),
            'emission_class'          => 'nullable|in:' . implode(',', \App\Models\Annonce::EMISSIONS),
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',

            'brand_id.exists' => 'La marque spécifiée n\'existe pas.',

            'car_model_id.exists' => 'Le modèle de voiture spécifié n\'existe pas.',

            'title.string'   => 'Le titre doit être une chaîne de caractères.',
            'title.max'      => 'Le titre ne peut pas dépasser 150 caractères.',
            'title.unique'   => 'Ce titre est déjà utilisé pour une autre annonce.',

            'sold.boolean'       => 'Le champ "vendu" doit être un booléen.',
            'visible.boolean'    => 'Le champ "visible" doit être un booléen.',
            'first_hand.boolean' => 'Le champ "première main" doit être un booléen.',

            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min'     => 'Le prix doit être d\'au moins 1.',
            'price.max'     => 'Le prix ne peut pas dépasser 10 000 000.',

            'mileage.integer' => 'Le kilométrage doit être un nombre entier.',
            'mileage.min'     => 'Le kilométrage doit être d\'au moins 1.',
            'mileage.max'     => 'Le kilométrage ne peut pas dépasser 999 999.',

            'fiscal_power.integer' => 'La puissance fiscale doit être un nombre entier.',
            'fiscal_power.min'     => 'La puissance fiscale doit être d\'au moins 1.',
            'fiscal_power.max'     => 'La puissance fiscale ne peut pas dépasser 1 500.',

            'horsepower.integer' => 'La puissance moteur doit être un nombre entier.',
            'horsepower.min'     => 'La puissance moteur doit être d\'au moins 1.',
            'horsepower.max'     => 'La puissance moteur ne peut pas dépasser 150.',

            'first_registration_date.date' => 'La date de première immatriculation doit être valide.',

            'city.string' => 'La ville doit être une chaîne de caractères.',
            'city.max'    => 'La ville ne peut pas dépasser 100 caractères.',

            'postal_code.string' => 'Le code postal doit être une chaîne de caractères.',
            'postal_code.size'   => 'Le code postal doit comporter exactement 5 caractères.',

            'latitude.numeric'  => 'La latitude doit être un nombre valide.',
            'longitude.numeric' => 'La longitude doit être un nombre valide.',

            'description.string' => 'La description doit être une chaîne de caractères.',

            'fuel.in' => 'Le type de carburant sélectionné est invalide.',

            'transmission.in' => 'La transmission sélectionnée est invalide.',

            'type.in' => 'Le type de véhicule sélectionné est invalide.',

            'doors.in' => 'Le nombre de portes sélectionné est invalide.',

            'seats.in' => 'Le nombre de sièges sélectionné est invalide.',

            'color.in' => 'La couleur sélectionnée est invalide.',

            'condition.in' => 'L\'état sélectionné est invalide.',

            'crit_air.in'       => 'La classe Crit\'Air sélectionnée est invalide.',
            'emission_class.in' => 'La classe d\'émissions sélectionnée est invalide.',
        ];
    }
}
