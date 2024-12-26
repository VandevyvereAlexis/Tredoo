<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'annonce_id',
    ];


    // Chaque favori est associé à un utilisateur
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Chaque favori est lié à une annonce
    public function annonce() {
        return $this->belongsTo(Annonce::class);
    }
}
