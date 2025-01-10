<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConversationState;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConversationStateRequest;

class ConversationStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversationStates = ConversationState::paginate(10);
        return response()->json($conversationStates, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConversationStateRequest $request)
    {
        //
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
