<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'car_models';

    protected $fillable = [
        'name',
        'brand_id',
    ];


    // Chaque modèle de voiture appartient à une marque
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // Un modèle peut être associé à plusieurs annonces
    public function annonces() {
        return $this->hasMany(Annonce::class);
    }
}


