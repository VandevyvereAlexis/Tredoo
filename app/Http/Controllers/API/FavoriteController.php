<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::paginate(10);
        return response()->json($favorites, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
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

        // Création du favori
        $favorite = Favorite::create($data);

        return response()->json([
            'message' => 'Favori ajouté avec succès.',
            'favorite' => $favorite
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
