<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with('images')->paginate(10);
        return response()->json($annonces, 200);
    }





    public function store(StoreAnnonceRequest $request)
    {
        $data = $request->validated();
        $annonce = Annonce::create($data);

        return response()->json([
            'message' => 'Annonce créée avec succès.',
            'annonce' => $annonce
        ], 201);
    }





    public function show($id)
    {
        $annonce = Annonce::with(['images', 'user', 'brand', 'carModel'])->find($id);

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





    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
        // Récupération des données validées
        $data = $request->validated();

        // Mise à jour de l'annonce avec les nouvelles données
        $annonce->update($data);

        return response()->json([
            'message' => 'Annonce mise à jour avec succès.',
            'annonce' => $annonce
        ], 200);
    }





    public function destroy(Annonce $annonce)
    {
        //
    }
}
