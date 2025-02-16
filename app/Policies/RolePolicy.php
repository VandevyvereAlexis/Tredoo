<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir tous les rôles.
    }

    public function view(User $user, Role $role)
    {
        return $user->isAdmin(); // Seul l'admin peut voir un rôle spécifique.
    }

    public function create(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut créer un rôle.
    }

    public function update(User $user, Role $role)
    {
        return $user->isAdmin(); // Seul l'admin peut modifier un rôle.
    }

    public function delete(User $user, Role $role)
    {
        return $user->isAdmin(); // Seul l'admin peut supprimer un rôle.
    }
}
