<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::paginate(10);
        return response()->json($conversations, 200);
    }





    public function store(StoreConversationRequest $request)
    {
        $validatedData = $request->validated();

        // Vérification si une conversation existe déjà pour ces paramètres
        $existingConversation = Conversation::where('annonce_id', $validatedData['annonce_id'])
            ->where('buyer_id', $validatedData['buyer_id'])
            ->where('seller_id', $validatedData['seller_id'])
            ->first();

        if ($existingConversation) {
            return response()->json([
                'message' => 'Une conversation existe déjà entre cet acheteur et ce vendeur pour cette annonce.',
                'conversation' => $existingConversation
            ], 409);
        }

        // Création d'une nouvelle conversation
        $conversation = Conversation::create([
            'annonce_id' => $validatedData['annonce_id'],
            'buyer_id' => $validatedData['buyer_id'],
            'seller_id' => $validatedData['seller_id'],
            'status' => 'ouverte', // Statut par défaut
        ]);

        return response()->json([
            'message' => 'Conversation créée avec succès.',
            'conversation' => $conversation
        ], 201);
    }





    public function show($id)
    {
        $conversation = Conversation::with(['annonce', 'buyer', 'seller', 'messages'])->find($id);

        if (!$conversation) {
            return response()->json([
                'message' => 'Conversation non trouvée.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails de la conversation récupérés avec succès.',
            'conversation' => $conversation
        ], 200);
    }





    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        $data = $request->validated();
        $conversation->update($data);

        return response()->json([
            'message' => 'Conversation mise à jour avec succès.',
            'conversation' => $conversation
        ], 200);
    }





    public function destroy(Conversation $conversation)
    {
        if (!$conversation) {
            return response()->json([
                'message' => 'Conversation non trouvée.',
            ], 404);
        }

        $conversation->delete();

        return response()->json([
            'message' => 'Conversation supprimée avec succès.',
        ], 200);
    }
}
