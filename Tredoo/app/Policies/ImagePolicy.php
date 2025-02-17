<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir toutes les images.
    }

    public function view(User $user, Image $image)
    {
        return $user->isAdmin() || $user->id === $image->annonce->user_id;
        // Seul l'admin ou le propriétaire de l'annonce peut voir ses images.
    }

    public function create(User $user, Image $image)
    {
        return $user->id === $image->annonce->user_id;
        // Seul le propriétaire de l'annonce peut ajouter des images.
    }

    public function update(User $user, Image $image)
    {
        return $user->id === $image->annonce->user_id;
        // Seul le propriétaire de l'annonce peut modifier ses images.
    }

    public function delete(User $user, Image $image)
    {
        return $user->isAdmin() || $user->id === $image->annonce->user_id;
        // Un utilisateur peut supprimer ses propres images, un admin peut tout supprimer.
    }
}
