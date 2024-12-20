<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationState extends Model
{
    use HasFactory;

    const STATUS = ['visible', 'supprimee', 'archivee'];
}
