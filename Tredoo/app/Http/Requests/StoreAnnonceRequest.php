<?php

namespace App\Http\Requests;

use App\Models\Annonce;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnnonceRequest extends FormRequest
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
            'user_id'                 => 'required|exists:users,id',
            'brand_id'                => 'required|exists:brands,id',
            'car_model_id'            => 'required|exists:car_models,id',
            'title'                   => 'required|string|max:150|unique:annonces,title',
            'sold'                    => 'boolean',
            'visible'                 => 'boolean',
            'first_hand'              => 'boolean',
            'price'                   => 'required|numeric|min:1|max:10000000',
            'mileage'                 => 'required|integer|min:1|max:999999',
            'fiscal_power'            => 'required|integer|min:1|max:1500',
            'horsepower'              => 'required|integer|min:1|max:150',
            'first_registration_date' => 'required|date',
            'city'                    => 'required|string|max:100',
            'postal_code'             => 'required|string|size:5',
            'latitude'                => 'nullable|numeric',
            'longitude'               => 'nullable|numeric',
            'description'             => 'required|string',
            'fuel'                    => 'required|in:' . implode(',', Annonce::FUELS),
            'transmission'            => 'required|in:' . implode(',', Annonce::TRANSMISSIONS),
            'type'                    => 'required|in:' . implode(',', Annonce::TYPES),
            'doors'                   => 'required|in:' . implode(',', Annonce::DOORS),
            'seats'                   => 'required|in:' . implode(',', Annonce::SEATS),
            'color'                   => 'required|in:' . implode(',', Annonce::COLORS),
            'condition'               => 'required|in:' . implode(',', Annonce::CONDITIONS),
            'crit_air'                => 'nullable|in:' . implode(',', Annonce::CRITAIRS),
            'emission_class'          => 'nullable|in:' . implode(',', Annonce::EMISSIONS),
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'identifiant de l\'utilisateur est requis.',
            'user_id.exists'   => 'L\'utilisateur sélectionné est invalide.',

            'brand_id.required' => 'L\'identifiant de la marque est requis.',
            'brand_id.exists'   => 'La marque sélectionnée est invalide.',

            'car_model_id.required' => 'L\'identifiant du modèle de voiture est requis.',
            'car_model_id.exists'   => 'Le modèle de voiture sélectionné est invalide.',

            'title.required' => 'Le titre est requis.',
            'title.string'   => 'Le titre doit être une chaîne de caractères.',
            'title.max'      => 'Le titre ne peut pas dépasser 150 caractères.',
            'title.unique'   => 'Ce titre est déjà utilisé.',

            'sold.boolean'       => 'Le champ "vendu" doit être un booléen.',
            'visible.boolean'    => 'Le champ "visible" doit être un booléen.',
            'first_hand.boolean' => 'Le champ "première main" doit être un booléen.',

            'price.required' => 'Le prix est requis.',
            'price.numeric'  => 'Le prix doit être un nombre.',
            'price.min'      => 'Le prix doit être au moins de 0.',
            'price.max'      => 'Le prix ne peut pas dépasser 10 000 000.',

            'mileage.required' => 'Le kilométrage est requis.',
            'mileage.integer'  => 'Le kilométrage doit être un entier.',
            'mileage.min'      => 'Le kilométrage doit être au moins de 0.',
            'mileage.max'      => 'Le kilométrage ne peut pas dépasser 999 999.',

            'fiscal_power.required' => 'La puissance fiscale est requise.',
            'fiscal_power.integer'  => 'La puissance fiscale doit être un entier.',
            'fiscal_power.min'      => 'La puissance fiscale doit être au moins de 0.',
            'fiscal_power.max'      => 'La puissance fiscale ne peut pas dépasser 1 500.',

            'horsepower.required' => 'La puissance moteur est requise.',
            'horsepower.integer'  => 'La puissance moteur doit être un entier.',
            'horsepower.min'      => 'La puissance moteur doit être au moins de 0.',

            'first_registration_date.required' => 'La date de première immatriculation est requise.',
            'first_registration_date.date'     => 'La date de première immatriculation doit être une date valide.',

            'city.required' => 'La ville est requise.',
            'city.string'   => 'La ville doit être une chaîne de caractères.',
            'city.max'      => 'La ville ne peut pas dépasser 100 caractères.',

            'postal_code.required' => 'Le code postal est requis.',
            'postal_code.string'   => 'Le code postal doit être une chaîne de caractères.',
            'postal_code.size'     => 'Le code postal doit comporter 5 caractères.',

            'latitude.numeric'  => 'La latitude doit être un nombre.',
            'longitude.numeric' => 'La longitude doit être un nombre.',

            'description.required' => 'La description est requise.',
            'description.string'  => 'La description doit être une chaîne de caractères.',

            'fuel.required' => 'Le type de carburant est requis.',
            'fuel.in'       => 'Le type de carburant sélectionné est invalide.',

            'transmission.required' => 'La transmission est requise.',
            'transmission.in'       => 'La transmission sélectionnée est invalide.',

            'type.required' => 'Le type de véhicule est requis.',
            'type.in'       => 'Le type de véhicule sélectionné est invalide.',

            'doors.required' => 'Le nombre de portes est requis.',
            'doors.in'       => 'Le nombre de portes sélectionné est invalide.',

            'seats.required' => 'Le nombre de sièges est requis.',
            'seats.in'       => 'Le nombre de sièges sélectionné est invalide.',

            'color.required' => 'La couleur est requise.',
            'color.in'       => 'La couleur sélectionnée est invalide.',

            'condition.required' => 'L\'état du véhicule est requis.',
            'condition.in'       => 'L\'état du véhicule sélectionné est invalide.',

            'crit_air.in'       => 'La classe Crit\'Air sélectionnée est invalide.',
            'emission_class.in' => 'La classe d\'émissions sélectionnée est invalide.',
        ];
    }
}
