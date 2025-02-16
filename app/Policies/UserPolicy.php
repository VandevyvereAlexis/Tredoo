<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir la liste complète des utilisateurs.
    }

    public function view(User $user, User $targetUser)
    {
        return $user->isAdmin() || $user->id === $targetUser->id;
        // Seul l'admin ou l'utilisateur concerné peuvent voir les détails de son compte.
    }

    public function create(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut créer un utilisateur.
    }

    public function update(User $user, User $targetUser)
    {
        return $user->isAdmin() || $user->id === $targetUser->id;
        // Un utilisateur peut modifier son propre compte, et l’admin peut modifier n'importe qui.
    }

    public function updatePassword(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id;
        // Seul l'utilisateur concerné peut modifier son propre mot de passe.
    }

    public function delete(User $user, User $targetUser)
    {
        return $user->isAdmin() || $user->id === $targetUser->id;
        // Un utilisateur peut supprimer son propre compte, et l’admin peut supprimer n’importe quel utilisateur.
    }
}
