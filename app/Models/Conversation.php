<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';

    protected $fillable = [
        'annonce_id',
        'buyer_id',
        'seller_id',
        'status',
    ];

    public const STATUS = [
        'ouverte',
        'fermee',
        'archivee',
        'en attente',
    ];


    // Chaque conversation est liée à une annonce
    public function annonce() {
        return $this->belongsTo(Annonce::class);
    }

    // Un utilisateur est l'acheteur dans une conversation
    public function buyer() {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Un utilisateur est le vendeur dans une conversation
    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Une conversation contient plusieurs messages échangés entre l'acheteur et le vendeur.
    public function messages() {
        return $this->hasMany(Message::class);
    }
}
