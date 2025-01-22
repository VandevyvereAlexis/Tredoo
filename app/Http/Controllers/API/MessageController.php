<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::paginate(10);
        return response()->json($messages, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
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

        // Créer le message
        $message = Message::create([
            'conversation_id' => $data['conversation_id'],
            'user_id' => $data['user_id'],
            'content' => $data['content'],
            'read' => $data['read'] ?? false, // Par défaut non lu
        ]);

        return response()->json([
            'message' => 'Message envoyé avec succès.',
            'message_details' => $message
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération du message avec ses relations
        $message = Message::with(['conversation', 'user'])->find($id);

        // Vérification si le message existe
        if (!$message) {
            return response()->json([
                'message' => 'Message non trouvé.',
            ], 404);
        }

        // Retour des détails du message
        return response()->json([
            'message' => 'Détails du message récupérés avec succès.',
            'message_details' => $message
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
