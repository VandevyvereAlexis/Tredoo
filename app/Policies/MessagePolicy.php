<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin(); // Seul l'admin peut voir tous les messages.
    }

    public function view(User $user, Message $message)
    {
        return $user->isAdmin()
            || $user->id === $message->user_id
            || in_array($user->id, [$message->conversation->buyer_id, $message->conversation->seller_id]);
        // Seul l'admin, l'auteur du message ou un participant de la conversation peuvent voir un message.
    }

    public function create(User $user, Message $message)
    {
        return in_array($user->id, [$message->conversation->buyer_id, $message->conversation->seller_id]);
        // Seuls les participants de la conversation peuvent envoyer un message.
    }

    public function update(User $user, Message $message)
    {
        return $user->id === $message->user_id;
        // Un utilisateur peut modifier uniquement ses propres messages.
    }

    public function delete(User $user, Message $message)
    {
        return $user->isAdmin() || $user->id === $message->user_id;
        // Un utilisateur peut supprimer ses propres messages, un admin peut tout supprimer.
    }
}
