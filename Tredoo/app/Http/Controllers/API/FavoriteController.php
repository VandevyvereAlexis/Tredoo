<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    public function __construct()
    {
        // Toutes les actions nécessitent une authentification
        $this->middleware('auth:sanctum');
    }





    public function index()
    {
        $this->authorize('viewAny', Favorite::class);

        $favorites = Favorite::paginate(10);
        return response()->json($favorites, 200);
    }





    public function store(StoreFavoriteRequest $request)
    {
        $this->authorize('create', Favorite::class);

        $data = $request->validated();

        // Vérification si le favori existe déjà
        $existingFavorite = Favorite::where('user_id', $data['user_id'])
            ->where('annonce_id', $data['annonce_id'])
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Ce favori existe déjà.',
                'favorite' => $existingFavorite
            ], 409);
        }

        $favorite = Favorite::create($data);

        return response()->json([
            'message' => 'Favori ajouté avec succès.',
            'favorite' => $favorite
        ], 201);
    }





    public function show($id)
    {
        $favorite = Favorite::with(['user', 'annonce'])->find($id);

        if (!$favorite) {
            return response()->json([
                'message' => 'Favori non trouvé.',
            ], 404);
        }

        $this->authorize('view', $favorite);

        return response()->json([
            'message' => 'Détails du favori récupérés avec succès.',
            'favorite' => $favorite
        ], 200);
    }





    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        $this->authorize('update', $favorite);

        $data = $request->validated();

        // Vérifie si un favori identique existe déjà pour un autre enregistrement
        $existingFavorite = Favorite::where('user_id', $data['user_id'] ?? $favorite->user_id)
            ->where('annonce_id', $data['annonce_id'] ?? $favorite->annonce_id)
            ->where('id', '!=', $favorite->id)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Un favori identique existe déjà.',
            ], 409);
        }

        // Mise à jour du favori
        $favorite->update($data);

        return response()->json([
            'message' => 'Favori mis à jour avec succès.',
            'favorite' => $favorite
        ], 200);
    }





    public function destroy($id)
    {
        $favorite = Favorite::find($id);

        if (!$favorite) {
            return response()->json([
                'message' => 'Favori non trouvé.',
            ], 404);
        }

        $this->authorize('delete', $favorite);

        $favorite->delete();

        return response()->json([
            'message' => 'Favori supprimé avec succès.',
        ], 200);
    }
}
