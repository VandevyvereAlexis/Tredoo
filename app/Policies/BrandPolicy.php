<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrandPolicy
{
    public function store(?User $user)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent créer.
    }

    public function update(?User $user, Brand $brand)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent modifier.
    }

    public function destroy(?User $user, Brand $brand)
    {
        return $user?->isAdmin() ?? false; // Seuls les admins peuvent supprimer.
    }
}
