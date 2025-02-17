<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnoncePolicy
{
    public function store(?User $user)
    {
        return $user !== null; // Un utilisateur connecté (user ou admin) peut créer une annonce.
    }

    public function update(?User $user, Annonce $annonce)
    {
        if ($user?->isAdmin()) {
            return true; // L'admin peut modifier toutes les annonces.
        }

        return $user?->id === $annonce->user_id; // Un utilisateur peut modifier sa propre annonce.
    }

    public function destroy(?User $user, Annonce $annonce)
    {
        if ($user?->isAdmin()) {
            return true; // L'admin peut supprimer toutes les annonces.
        }

        return $user?->id === $annonce->user_id; // Un utilisateur peut supprimer sa propre annonce.
    }
}
