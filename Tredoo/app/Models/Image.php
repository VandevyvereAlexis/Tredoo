<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'images';

    protected $fillable = [
        'annonce_id',
        'url',
        'position',
    ];


    // Chaque image est liée à une annonce spécifique
    public function annonce() {
        return $this->belongsTo(Annonce::class);
    }
}
