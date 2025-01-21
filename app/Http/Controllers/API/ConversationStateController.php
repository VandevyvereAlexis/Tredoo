<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConversationState;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConversationStateRequest;
use App\Models\Conversation;

class ConversationStateController extends Controller
{
    public function index()
    {
        $conversationStates = ConversationState::paginate(10);
        return response()->json($conversationStates, 200);
    }





    public function store(StoreConversationStateRequest $request)
    {
        $validatedData = $request->validated();

        // Vérification si un état existe déjà pour cet utilisateur et cette conversation
        $existingState = ConversationState::where('conversation_id', $validatedData['conversation_id'])
            ->where('user_id', $validatedData['user_id'])
            ->first();

        if ($existingState) {
            return response()->json([
                'message' => 'Un état pour cette conversation et cet utilisateur existe déjà.',
                'conversation_state' => $existingState
            ], 409);
        }

        // Création d'un nouvel état de conversation
        $conversationState = ConversationState::create([
            'conversation_id' => $validatedData['conversation_id'],
            'user_id' => $validatedData['user_id'],
            'status' => $validatedData['status'],
        ]);

        return response()->json([
            'message' => 'État de conversation créé avec succès.',
            'conversation_state' => $conversationState
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show(ConversationState $conversationState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConversationState $conversationState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConversationState $conversationState)
    {
        //
    }
}
