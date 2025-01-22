<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::paginate(10);
        return response()->json($favorites, 200);
    }





    public function store(StoreFavoriteRequest $request)
    {
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

        return response()->json([
            'message' => 'Détails du favori récupérés avec succès.',
            'favorite' => $favorite
        ], 200);
    }





    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
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





    public function destroy(Favorite $favorite)
    {
        //
    }
}
