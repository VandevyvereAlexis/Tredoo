<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir toutes les conversations.
    }

    public function view(User $user, Conversation $conversation)
    {
        return $user->isAdmin()
            || $user->id === $conversation->buyer_id
            || $user->id === $conversation->seller_id;
        // Admin, acheteur et vendeur peuvent voir la conversation.
    }

    public function store(User $user)
    {
        return $user !== null; // Un utilisateur connecté peut créer une conversation.
    }

    public function update(User $user, Conversation $conversation)
    {
        return $user->isAdmin()
            || $user->id === $conversation->buyer_id
            || $user->id === $conversation->seller_id;
        // Seul l'admin ou les participants (acheteur/vendeur) peuvent modifier.
    }

    public function destroy(User $user, Conversation $conversation)
    {
        return $user->isAdmin(); // Seul l'admin peut supprimer une conversation.
    }
}
