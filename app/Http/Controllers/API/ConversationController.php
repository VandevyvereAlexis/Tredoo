<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConversationRequest;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversations = Conversation::paginate(10);
        return response()->json($conversations, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
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





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de la conversation avec ses relations
        $conversation = Conversation::with(['annonce', 'buyer', 'seller', 'messages'])->find($id);

        // Vérification si la conversation existe
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





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
