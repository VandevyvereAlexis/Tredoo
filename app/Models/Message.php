<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'messages';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'content',
        'read',
    ];


    // Chaque message est lié à une conversation spécifique
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }

    // Chaque message est envoyé par un utilisateur
    public function user() {
        return $this->belongsTo(User::class);
    }
}
