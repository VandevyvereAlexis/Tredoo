<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Annonce extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'annonces';

    protected $fillable = [
        'user_id',
        'brand_id',
        'car_model_id',
        'title',
        'sold',
        'visible',
        'first_hand',
        'price',
        'mileage',
        'fiscal_power',
        'horsepower',
        'first_registration_date',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'description',
        'fuel',
        'transmission',
        'type',
        'doors',
        'seats',
        'color',
        'condition',
        'crit_air',
        'emission_class'
    ];


    const FUELS = [
        'essence',
        'diesel',
        'hybride',
        'electrique',
        'gpl',
        'gaz_naturel_cgn',
        'autre'
    ];

    const TRANSMISSIONS = [
        'automatique',
        'manuelle'
    ];

    const TYPES = [
        '4x4_suv_crossover',
        'Citadine',
        'berline',
        'break',
        'cabriolet',
        'coupé',
        'monospace_minibus',
        'commerciale_société',
        'sans_permis',
        'autre'
    ];

    const DOORS = [
        '3_portes',
        '4_portes',
        '5_portes',
        '6_portes_ou_plus'
    ];

    const SEATS = [
        '1_place',
        '2_places',
        '3_places',
        '4_places',
        '5_places',
        '6_places',
        '7_ou_plus'
    ];

    const COLORS = [
        'blanc',
        'noir',
        'gris',
        'argent',
        'bleu',
        'rouge',
        'vert',
        'marron',
        'beige',
        'jaune',
        'autre'
    ];

    const CONDITIONS = [
        'sans_frais_a_prevoir',
        'roulante_reparation_a_prevoir',
        'non_roulante',
        'accidentee',
        'pour_pieces'
    ];

    const CRITAIRS = [
        'crit_air_1',
        'crit_air_2',
        'crit_air_3',
        'crit_air_4',
        'crit_air_5',
        'non_classe'
    ];

    const EMISSIONS = [
        'euro_1',
        'euro_2',
        'euro_3',
        'euro_4',
        'euro_5',
        'euro_6',
        'autre'
    ];


    // Chaque annonce appartient à un utilisateur
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Une annonce est associée à une marque spécifique
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // Une annonce peut référencer un modèle spécifique
    public function carModel() {
        return $this->belongsTo(CarModel::class);
    }

    // Une annonce peut avoir plusieurs images
    public function images() {
        return $this->hasMany(Image::class);
    }

    // Le vendeur est l'utilisateur qui a créé l'annonce
    public function seller() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
