<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FavoritePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir tous les favoris.
    }

    public function view(User $user, Favorite $favorite)
    {
        return $user->isAdmin() || $user->id === $favorite->user_id;
        // Seul l'admin ou l'utilisateur concerné peuvent voir leurs propres favoris.
    }

    public function create(User $user)
    {
        return $user !== null; // Tout utilisateur connecté peut ajouter un favori.
    }

    public function update(User $user, Favorite $favorite)
    {
        return $user->isAdmin(); // Seul l'admin peut modifier un favori.
    }

    public function delete(User $user, Favorite $favorite)
    {
        return $user->isAdmin() || $user->id === $favorite->user_id;
        // Un utilisateur peut supprimer ses propres favoris, un admin peut tout supprimer.
    }
}
