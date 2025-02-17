<?php

namespace App\Policies;

use App\Models\ConversationState;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationStatePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir tous les états des conversations.
    }

    public function view(User $user, ConversationState $conversationState)
    {
        return $user->isAdmin() || $user->id === $conversationState->user_id;
        // Seul l'admin ou l'utilisateur concerné peuvent voir leur propre état.
    }

    public function create(User $user, ConversationState $conversationState)
    {
        return $user->id === $conversationState->user_id;
        // Un utilisateur peut créer un état de conversation uniquement pour lui-même.
    }

    public function update(User $user, ConversationState $conversationState)
    {
        return $user->id === $conversationState->user_id;
        // Un utilisateur peut modifier son propre état de conversation.
    }

    public function delete(User $user, ConversationState $conversationState)
    {
        return $user->isAdmin(); // Seul l'admin peut supprimer un état de conversation.
    }
}
