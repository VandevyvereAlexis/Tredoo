<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnonceRequest;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::with('images')->paginate(10);
        return response()->json($annonces, 200);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnonceRequest $request)
    {
        $data = $request->validated();
        $annonce = Annonce::create($data);

        return response()->json([
            'message' => 'Annonce créée avec succès.',
            'annonce' => $annonce
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de l'annonce avec ses relations
        $annonce = Annonce::with(['images', 'user', 'brand', 'carModel'])->find($id);

        // Vérification si l'annonce existe
        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce non trouvée.',
            ], 404);
        }

        return response()->json([
            'message' => 'Détails de l\'annonce récupérés avec succès.',
            'annonce' => $annonce
        ], 200);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
