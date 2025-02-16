<?php

namespace App\Policies;

use App\Models\CarModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarModelPolicy
{
    public function store(?User $user)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent créer.
    }

    public function update(?User $user, CarModel $carModel)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent modifier.
    }

    public function destroy(?User $user, CarModel $carModel)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent supprimer.
    }
}
