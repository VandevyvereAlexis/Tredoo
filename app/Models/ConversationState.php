<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationState extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'conversation_states';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'status',
    ];

    const STATUS = [
        'visible',
        'supprimee',
        'archivee'
    ];


    // Chaque état de conversation est lié à une conversation
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }

    // Chaque état de conversation est associé à un utilisateur
    public function user() {
        return $this->belongsTo(User::class);
    }
}
