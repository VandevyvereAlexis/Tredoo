<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'last_name',
        'first_name',
        'username',
        'email',
        'password',
        'profile_image',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Chaque utilisateur possède un rôle.
    public function role() {
        return $this->belongsTo(Role::class);
    }

    // Un utilisateur peut avoir plusieurs annonces.
    public function annonces() {
        return $this->hasMany(Annonce::class);
    }

    // Un utilisateur peut être un acheteur dans plusieurs conversations.
    public function conversationsAsBuyer() {
        return $this->hasMany(Conversation::class, 'buyer_id');
    }

    // Un utilisateur peut être un vendeur dans plusieurs conversations.
    public function conversationsAsSeller() {
        return $this->hasMany(Conversation::class, 'seller_id');
    }
}
