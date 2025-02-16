<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;

class AnnonceController extends Controller
{
    public function __construct()
    {
        // Seules les actions 'index' et 'show' sont publiques
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }





    public function index()
    {
        $annonces = Annonce::with('images')->paginate(10);
        return response()->json($annonces, 200);
    }





    public function store(StoreAnnonceRequest $request)
    {
        $this->authorize('store', Annonce::class);

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
        $this->authorize('update', $annonce);

        $data = $request->validated();
        $annonce->update($data);

        return response()->json([
            'message' => 'Annonce mise à jour avec succès.',
            'annonce' => $annonce
        ], 200);
    }





    public function destroy(Annonce $annonce)
    {
        $this->authorize('destroy', $annonce);

        $annonce->delete();

        return response()->json([
            'message' => 'Annonce supprimée avec succès.'
        ], 200);
    }
}
