<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConversationState;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConversationStateRequest;
use App\Http\Requests\UpdateConversationStateRequest;

class ConversationStateController extends Controller
{
    public function __construct()
    {
        // Toutes les actions nécessitent une authentification
        $this->middleware('auth:sanctum');
    }





    public function index()
    {
        $this->authorize('viewAny', ConversationState::class);

        $conversationStates = ConversationState::paginate(10);
        return response()->json($conversationStates, 200);
    }





    public function store(StoreConversationStateRequest $request)
    {
        $validatedData = $request->validated();

        $existingState = ConversationState::where('conversation_id', $validatedData['conversation_id'])
            ->where('user_id', $validatedData['user_id'])
            ->first();

        if ($existingState) {
            return response()->json([
                'message' => 'Un état pour cette conversation et cet utilisateur existe déjà.',
                'conversation_state' => $existingState
            ], 409);
        }

        $conversationState = new ConversationState([
            'conversation_id' => $validatedData['conversation_id'],
            'user_id' => $validatedData['user_id'],
            'status' => $validatedData['status'],
        ]);

        $this->authorize('create', $conversationState);

        $conversationState->save();

        return response()->json([
            'message' => 'État de conversation créé avec succès.',
            'conversation_state' => $conversationState
        ], 201);
    }





    public function show($id)
    {
        $conversationState = ConversationState::with(['conversation', 'user'])->find($id);

        if (!$conversationState) {
            return response()->json([
                'message' => 'État de conversation non trouvé.',
            ], 404);
        }

        $this->authorize('view', $conversationState);

        return response()->json([
            'message' => 'Détails de l\'état de conversation récupérés avec succès.',
            'conversation_state' => $conversationState
        ], 200);
    }





    public function update(UpdateConversationStateRequest $request, $id)
    {
        // Recherche explicite de l'état de conversation
        $conversationState = ConversationState::find($id);

        if (!$conversationState) {
            return response()->json([
                'message' => 'État de conversation introuvable.',
            ], 404);
        }

        $this->authorize('update', $conversationState);

        $data = $request->validated();
        $conversationState->fill($data)->save();

        return response()->json([
            'message' => 'État de conversation mis à jour avec succès.',
            'conversation_state' => $conversationState->fresh(),
        ], 200);
    }





    public function destroy($id)
    {
        // Recherche explicite de l'état de conversation
        $conversationState = ConversationState::find($id);

        if (!$conversationState) {
            return response()->json([
                'message' => 'État de conversation non trouvé.',
            ], 404);
        }

        $this->authorize('delete', $conversationState);

        $conversationState->delete();

        return response()->json([
            'message' => 'État de conversation supprimé avec succès.',
        ], 200);
    }
}
