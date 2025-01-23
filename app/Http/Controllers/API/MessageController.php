<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::paginate(10);
        return response()->json($messages, 200);
    }





    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();

        // Vérifier si l'utilisateur est participant de la conversation
        $conversation = Conversation::findOrFail($data['conversation_id']);
        if (!in_array($data['user_id'], [$conversation->buyer_id, $conversation->seller_id])) {
            return response()->json([
                'message' => 'L\'utilisateur n\'est pas participant de cette conversation.'
            ], 403);
        }

        $message = Message::create([
            'conversation_id' => $data['conversation_id'],
            'user_id' => $data['user_id'],
            'content' => $data['content'],
            'read' => $data['read'] ?? false,
        ]);

        return response()->json([
            'message' => 'Message envoyé avec succès.',
            'message_details' => $message
        ], 201);
    }





    public function show($id)
    {
        $message = Message::with(['conversation', 'user'])->find($id);

        if (!$message) {
            return response()->json([
                'message' => 'Message non trouvé.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails du message récupérés avec succès.',
            'message_details' => $message
        ], 200);
    }





    public function update(UpdateMessageRequest $request, Message $message)
    {
        $data = $request->validated();
        $message->update($data);

        return response()->json([
            'message' => 'Message mis à jour avec succès.',
            'message_details' => $message
        ], 200);
    }





    public function destroy(Message $message)
    {
        //
    }
}
